<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('team.show', compact('team'));
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
}
