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
        $teams = Team::all();
        $users = User::all();

        return view('InternalCollaboration.index', compact('internalCollaborations', 'teams', 'users')); // a rediriger
    }

    public function create()
    {
        $teams = Team::all();
        $users = User::all();

        return view('InternalCollaboration.index', compact('teams', 'users')); // a rediriger
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_id' => 'nullable|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'type' => 'required|in:global,team,both',
        ]);

        if ($request->type === 'global') {
            InternalCollaboration::create([
                'team_id' => null,
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);
        } elseif ($request->type === 'team') {
            InternalCollaboration::create([
                'team_id' => $request->team_id,
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);
        } elseif ($request->type === 'both') {
            // message global
            InternalCollaboration::create([
                'team_id' => null,
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);

            // message équipe
            InternalCollaboration::create([
                'team_id' => $request->team_id,
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);
        }

        return redirect()->route('internal-collaboration.index'); // a rediriger
    }

    public function show(string $id)
    {
        $internalCollaboration = InternalCollaboration::with(['team', 'user'])->findOrFail($id);

        return view('InternalCollaboration.show', compact('internalCollaboration')); // a rediriger
    }

    public function edit(string $id)
    {
        $internalCollaboration = InternalCollaboration::findOrFail($id);
        $teams = Team::all();
        $users = User::all();

        return view('InternalCollaboration.edit', compact('internalCollaboration', 'teams', 'users')); // a rediriger
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

        return redirect()->route('InternalCollaboration.index');
    }

    public function destroy(string $id)
    {
        $internalCollaboration = InternalCollaboration::findOrFail($id);

        $internalCollaboration->delete();

        return redirect()->route('InternalCollaboration.index');
    }
}
