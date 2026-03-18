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
    public function index($client_id = null)
    {
        if ($client_id) {
            $interactions = Interaction::where('client_id', $client_id)->get();
            $client = Client::findOrFail($client_id);
        } else {
            $interactions = Interaction::all();
            $client = null;
        }

        return view('interactions.index', compact('interactions', 'client'));
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

    public function byClient($client_id)
    {
        $client = Client::findOrFail($client_id);
        $interactions = Interaction::where('client_id', $client_id)->get();

        return view('interactions.index', compact('interactions', 'client'));
    }
}
