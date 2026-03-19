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
            'type' => 'required|in:appel,email,rendez-vous',
            'date' => 'required|date',
            'sujet' => 'nullable|string',
            'contenu' => 'nullable|string',
        ]);

        Interaction::create($validated);

        return back()->with('success', 'Interaction ajoutée');
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

        // 4. On récupère les résultats triés par date
        $interactions = $query->orderBy('date', 'desc')->get();

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
}
