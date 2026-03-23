<?php

namespace App\Http\Controllers;

use App\Models\User; // Ajouté
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\DemandeClient;

class DemandeClientController extends Controller
{
    public function index(Request $request)
    {
        // On charge aussi la relation avec l'utilisateur assigné
        $query = DemandeClient::with(['client', 'user']);

        $client_id = $request->query('client_id');
        $client = null;

        if ($client_id) {
            $query->where('client_id', $client_id);
            $client = Client::findOrFail($client_id);
        }

        $demandes = $query->latest()->get();

        return view('demandes.index', compact('demandes', 'client'));
    }

    public function create()
    {
        $clients = Client::all();
        $users = User::all(); // On récupère tous les membres pour l'assignation
        return view('demandes.create', compact('clients', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id'   => 'nullable|exists:users,id', // Ajouté : optionnel si pas encore assigné
            'email'     => 'required|email|max:255',
            'sujet'     => 'required|string|max:255',
            'message'   => 'required|string',
            'statut'    => 'required|string|max:50',
        ]);

        $demande = DemandeClient::create($validated);

        if($request->ajax()) {
            return response()->json($demande, 201);
        }

        return redirect()->route('demandes.index')->with('success', 'Demande créée et assignée avec succès');
    }

    public function show($id)
    {
        // On affiche aussi qui est en charge de la demande
        $demande = DemandeClient::with(['client', 'user'])->findOrFail($id);
        return view('demandes.show', compact('demande'));
    }

    public function update(Request $request, $id)
    {
        $demande = DemandeClient::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id'   => 'nullable|exists:users,id', // Ajouté
            'email'     => 'required|email|max:255',
            'sujet'     => 'required|string|max:255',
            'message'   => 'required|string',
            'statut'    => 'required|string|max:50',
        ]);

        $demande->update($validated);

        if ($request->ajax()) {
            return response()->json($demande, 200);
        }

        return redirect()->route('demandes.index')->with('success', 'Demande mise à jour avec succès');
    }

    public function destroy($id)
    {
        $demande = DemandeClient::findOrFail($id);
        $demande->delete();

        return redirect()->route('demandes.index')->with('success', 'Demande supprimée avec succès');
    }
    // Affiche la page d'assignation
    public function assignation($id)
    {
        $demande = DemandeClient::with(['client', 'user'])->findOrFail($id);
        $users = User::all(); // On récupère l'équipe pour le menu déroulant

        return view('demandes.assignation', compact('demande', 'users'));
    }

// Traite l'assignation (Action de validation)
    public function storeAssignation(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
        ]);

        $demande = DemandeClient::findOrFail($id);
        $demande->update(['user_id' => $request->user_id]);

        return redirect()->route('demandes.index')
            ->with('success', 'Le membre de l\'équipe a été assigné avec succès.');
    }
    public function edit($id)
    {
        // 1. On récupère la demande avec ses relations
        $demande = DemandeClient::with(['client', 'user'])->findOrFail($id);

        // 2. On récupère la liste des clients et des membres d'équipe pour les menus déroulants
        $clients = Client::all();
        $users = User::all();

        // 3. On retourne la vue d'édition
        return view('demandes.edit', compact('demande', 'clients', 'users'));
    }
}
