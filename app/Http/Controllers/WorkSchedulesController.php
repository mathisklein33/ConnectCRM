<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class WorkSchedulesController extends Controller
{
    public function index()
    {
        $workSchedules = WorkSchedule::with(['team', 'user'])->get();

        return view('#', compact('workSchedules')); // a rediriger
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
            'user_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        WorkSchedule::create($validated);

        return redirect()->route('#'); // a rediriger
    }

    public function show(string $id)
    {
        $workSchedule = WorkSchedule::with(['team', 'user'])->findOrFail($id);

        return view('#', compact('workSchedule'));// a rediriger
    }

    public function edit(string $id)
    {
        $workSchedule = WorkSchedule::findOrFail($id);
        $teams = Team::all();
        $users = User::all();

        return view('#', compact('workSchedule', 'teams', 'users')); // a rediriger
    }

    public function update(Request $request, string $id)
    {
        $workSchedule = WorkSchedule::findOrFail($id);

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
        $workSchedule = WorkSchedule::findOrFail($id);

        $workSchedule->delete();

        return redirect()->route('#'); // a rediriger
    }
}
