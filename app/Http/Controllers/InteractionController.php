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
            'type'      => 'required|in:appel,email,rendez-vous',
            'date'      => 'required|date', // Peut être futur pour planification
            'sujet'     => 'required|string|max:255',
            'contenu'   => 'nullable|string',
            'statut'    => 'required|in:planifie,realise,annule',
        ]);

        Interaction::create($validated);

        return redirect()->route('interactions.index')
            ->with('success', 'Le nouveau schedules a été programmé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $interaction = Interaction::findOrFail($id);

        $validated = $request->validate([
            'type'      => 'required|in:appel,email,rendez-vous',
            'date'      => 'required|date',
            'sujet'     => 'required|string|max:255',
            'contenu'   => 'nullable|string', // Utile pour noter le résumé après le rdv
            'statut'    => 'required|in:planifie,realise,annule',
        ]);

        $interaction->update($validated);

        return redirect()->route('interactions.index')
            ->with('success', 'Schedules mis à jour.');
    }
    public function index(Request $request, $client_id = null)
    {
        // 1. On initialise la requête avec la relation client pour éviter les lenteurs (Eager Loading)
        $query = Interaction::with('client');

        // 2. Filtre par Client (si l'ID est dans l'URL)
        $client = null;
        if ($client_id) {
            $query->where('client_id', $client_id);
            $client = Client::findOrFail($client_id);
        }

        // 3. Filtre par Type (si le select du formulaire est utilisé)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        // Séparer les schedules passés et futurs si besoin via le statut
        if ($request->has('en_cours')) {
            $query->where('statut', 'planifie');
        }

        // 4. On récupère les résultats triés par date
        $interactions = $query->orderBy('date', 'desc')->paginate(10);
        // 5. On récupère la liste unique des types pour le menu déroulant
        $types = Interaction::distinct()->pluck('type');

        return view('interactions.index', compact('interactions', 'client', 'types'));
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
    public function edit($id)
    {
        $interaction = Interaction::with('client')->findOrFail($id);
        // On récupère le client pour l'affichage du nom dans le header
        $client = $interaction->client;

        return view('interactions.edit', compact('interaction', 'client'));
    }
}
