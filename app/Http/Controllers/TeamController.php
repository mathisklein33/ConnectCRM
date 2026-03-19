<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Afficher la liste des équipes.
     */
    public function index()
    {
        $teams = Team::all();

        return view('#', compact('teams')); // a remplacer
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('#'); // a remplacer
    }

    /**
     * Enregistrer une nouvelle équipe.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Team::create($validated);

        return redirect()->route('#');// a remplacer
    }

    /**
     * Afficher une équipe.
     */
    public function show(string $id)
    {
        $team = Team::findOrFail($id);

        return view('#', compact('team')); // a remplacer
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $team = Team::findOrFail($id);

        return view('#', compact('team')); // a remplacer
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

        return redirect()->route('#'); // a remplacer
    }

    /**
     * Supprimer une équipe.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        $team->delete();

        return redirect()->route('#'); // a remplacer
    }
}
