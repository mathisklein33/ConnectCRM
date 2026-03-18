<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\InternalCollaboration;
use Illuminate\Http\Request;

class InternalCollaborationController extends Controller
{

    public function index()
    {
        $internalCollaborations = InternalCollaboration::with(['team', 'user'])->get();

        return view('#', compact('internalCollaborations')); // a rediriger
    }

    public function create()
    {
        $teams = Team::all();
        $users = User::all();

        return view('#', compact('teams', 'users')); // a rediriger
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        InternalCollaboration::create($validated);

        return redirect()->route('#'); // a rediriger
    }

    public function show(string $id)
    {
        $internalCollaboration = InternalCollaboration::with(['team', 'user'])->findOrFail($id);

        return view('#', compact('internalCollaboration')); // a rediriger
    }

    public function edit(string $id)
    {
        $internalCollaboration = InternalCollaboration::findOrFail($id);
        $teams = Team::all();
        $users = User::all();

        return view('#', compact('internalCollaboration', 'teams', 'users')); // a rediriger
    }

    public function update(Request $request, string $id)
    {
        $internalCollaboration = InternalCollaboration::findOrFail($id);

        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $internalCollaboration->update($validated);

        return redirect()->route('#');// a rediriger
    }

    public function destroy(string $id)
    {
        $internalCollaboration = InternalCollaboration::findOrFail($id);

        $internalCollaboration->delete();

        return redirect()->route('#'); // a rediriger
    }
}
