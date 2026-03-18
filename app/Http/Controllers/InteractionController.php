<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Client;


class InteractionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|in:appel,email,rdv',
            'date' => 'required|date',
            'sujet' => 'nullable|string',
            'contenu' => 'nullable|string',
        ]);

        Interaction::create($validated);

        return back()->with('success', 'Interaction ajoutée');
    }
    public function index()
    {
        $interactions = Interaction::all();
        $client = Client::all();
        return view('interactions.index', compact('interactions'));
    }

    public function create($client_id)
    {
        $client = Client::findOrFail($client_id);
        return view('interactions.create', compact('client'));
    }

    public function show($id)
    {
        $interaction = Interaction::with('client')->findOrFail($id);
        return view('interactions.show', compact('interaction'));
    }
}
