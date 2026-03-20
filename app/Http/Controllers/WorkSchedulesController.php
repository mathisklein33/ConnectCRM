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
        $teams = Team::all();
        $users = User::all();

        // On renvoie juste la vue. C'est le JS qui chargera les données après.
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
    public function getEvents()
    {
        $schedules = Work_schedules::all();

        $data = $schedules->map(function ($item) {
            // Nettoyage de la date pour éviter le format 00:00:00T09:00:00
            $onlyDate = substr($item->date, 0, 10);

            return [
                'id'    => $item->id,
                'title' => $item->title,
                'start' => $onlyDate . 'T' . $item->start_time,
                'end'   => $onlyDate . 'T' . ($item->end_time ?? $item->start_time),
                'extendedProps' => [
                    'description' => $item->description,
                    'user' => $item->user->name ?? 'N/A'
                ]
            ];
        });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            // On crée l'enregistrement
            $schedule = \App\Models\Work_schedules::create([
                'title'       => $request->title,
                'description' => $request->description,
                'date'        => $request->date,
                'start_time'  => $request->start_time,
                'end_time'    => $request->end_time ?? $request->start_time,
                'user_id'     => auth()->id() ?? 1, // On force l'ID 1 si pas connecté
                'team_id'     => 1,
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
