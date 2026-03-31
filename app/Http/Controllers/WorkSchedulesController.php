<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Work_schedules;
use Illuminate\Http\Request;

class WorkSchedulesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $users = User::with('teams')->get();


        if ($user->hasRole('admin')) {
            // L'admin voit toutes les équipes pour le sélecteur
            $teams = Team::all();
        } else {
            // Le manager (ou simple user) ne voit QUE ses équipes rattachées
            $teams = $user->teams;
        }

        return view('schedules.index', compact('teams', 'users'));
    }
    public function create()
    {
        $teams = Team::all();
        $users = User::all();
        return view('schedules.create', compact('teams', 'users'));
    }

    /**
     * Fournit les données JSON au calendrier FullCalendar
     */
    public function getEvents(Request $request)
    {
        $user = auth()->user();
        $query = Work_schedules::query();

        // 1. On récupère les IDs des équipes auxquelles l'utilisateur appartient via la table pivot
        // (Fonctionne pour Manager et Simple User si nécessaire)
        $userTeamIds = $user->teams()->pluck('teams.id')->toArray();

        // --- ÉTAPE A : Restriction selon le ROLE ---

        if ($user->hasRole('admin')) {
            // L'admin n'a aucune restriction de base.
        }
        elseif ($user->hasRole('manager')) {
            // Le manager peut voir :
            // - Ce qui est global (team_id null)
            // - OU ce qui appartient à ses équipes
            $query->where(function($q) use ($userTeamIds) {
                $q->whereNull('team_id')
                    ->orWhereIn('team_id', $userTeamIds);
            });
        }
        else {
            // L'utilisateur simple : uniquement SES rendez-vous personnels
            $query->where('user_id', $user->id);
        }

        // --- ÉTAPE B : Application du FILTRE (Vue Globale vs Équipe) ---

        if ($request->filled('team_id')) {
            $requestedId = $request->team_id;

            // Sécurité : Si pas admin, on vérifie qu'il appartient bien à l'équipe demandée
            if (!$user->hasRole('admin') && !in_array($requestedId, $userTeamIds)) {
                return response()->json([], 403); // Interdit s'il n'est pas dans l'équipe
            }

            $query->where('team_id', $requestedId);
        } else {
            // Si aucun team_id n'est passé, on ne montre que le Global (team_id IS NULL)
            $query->whereNull('team_id');
        }

        $schedules = $query->get();

        return response()->json($schedules->map(function ($item) {
            return [
                'id'    => $item->id,
                'title' => $item->title,
                'start' => substr($item->date, 0, 10) . 'T' . $item->start_time,
                'end'   => substr($item->date, 0, 10) . 'T' . $item->end_time, // ← ajout
                'extendedProps' => [
                    'description' => $item->description,
                ]
            ];
        }));
    }
    public function store(Request $request)
    {
        try {
            // On crée l'enregistrement
            $schedule = Work_schedules::create([
                'title'       => $request->title,
                'description' => $request->description,
                'date'        => $request->date,
                'start_time'  => $request->start_time,
                'end_time'    => $request->end_time ?? $request->start_time,
                'user_id'     => auth()->id(), // On force l'ID 1 si pas connecté
                'team_id'     => $request->team_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Enregistré avec succès !',
                'data'    => $schedule
            ]);

        } catch (\Exception $e) {
            // Si ça plante, on envoie l'erreur en JSON au lieu de laisser PHP planter
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        $workSchedule = Work_schedules::with(['team', 'user'])->findOrFail($id);

        return view('#', compact('workSchedule'));// a rediriger
    }

    public function edit(string $id)
    {
        $workSchedule = Work_schedules::findOrFail($id);
        $teams = Team::all();
        $users = User::all();

        return view('#', compact('workSchedule', 'teams', 'users')); // a rediriger
    }

    public function update(Request $request, string $id)
    {
        $workSchedule = Work_schedules::findOrFail($id);

        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $workSchedule->update($validated);

        return redirect()->route('#'); // a rediriger
    }

    public function destroy(string $id)
    {
        $workSchedule = Work_schedules::findOrFail($id);

        $workSchedule->delete();

        return redirect()->route('#'); // a rediriger
    }
}
