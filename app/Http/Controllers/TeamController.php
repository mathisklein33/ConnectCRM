<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Afficher la liste des équipes.
     */
    public function index()
    {
        $teams = Team::all();

        return view('team.index', compact('teams'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $users = User::all();
        return view('team.create', compact('users'));
    }

    /**
     * Enregistrer une nouvelle équipe.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);

        Team::create($validated);

        return redirect()->route('team.index');
        }

    /**
     * Afficher une équipe.
     */
    public function show(string $id)
    {
        $team = Team::findOrFail($id);
        $user = auth()->user();
        $users = User::with('teams')->get();


        if ($user->hasRole('admin')) {
            // L'admin voit toutes les équipes pour le sélecteur
            $teams = Team::all();
        } else {
            // Le manager (ou simple user) ne voit QUE ses équipes rattachées
            $teams = $user->teams;
        }
        return view('team.show', compact('team', 'teams', 'users', 'user'));
    }


    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $users = User::all();

        $team = Team::findOrFail($id);

        return view('team.edit', compact('team', 'users'));
    }

    /**
     * Mettre à jour une équipe.
     */
    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update($validated);

        return redirect()->route('team.index');
    }

    /**
     * Supprimer une équipe.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        $team->delete();

        return redirect()->route('team.index');
       }
    public function manage($teamId)
    {
        $teamUsers = TeamUser::with('user')->where('team_id', $teamId)->get();
        $allUsers = User::all(); // Ou une liste filtrée d'utilisateurs éligibles

        return view('team.manage', compact('teamUsers', 'teamId', 'allUsers'));
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'role'    => 'required|in:member,editor,admin',
        ]);

        // Vérifier si l'utilisateur est déjà dans l'équipe
        $exists = DB::table('team_user')
            ->where('team_id', $request->team_id)
            ->where('user_id', $request->user_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Cet utilisateur fait déjà partie de l’équipe.');
        }

        // Insertion dans la table pivot
        DB::table('team_user')->insert([
            'team_id'    => $request->team_id,
            'user_id'    => $request->user_id,
            'role'       => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Membre ajouté avec succès.');
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:member,editor,admin'
        ]);

        // On met à jour la ligne dans la table pivot team_user
        DB::table('team_user')
            ->where('id', $id)
            ->update([
                'role' => $request->role,
                'updated_at' => now()
            ]);

        return back()->with('success', 'Rôle mis à jour avec succès.');
    }
    public function removeUser($id)
    {
        // On cherche la ligne dans la table pivot par son ID
        $member = \DB::table('team_user')->where('id', $id);

        if ($member->exists()) {
            $member->delete();
            return back()->with('success', 'Le membre a été retiré de l\'équipe.');
        }

        return back()->with('error', 'Membre introuvable.');
    }
}
