<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProjetClient;
use Illuminate\Http\Request;

class ProjetClientController extends Controller
{

    public function index()
    {
        $projetClients = ProjetClient::with('client')->get();

        return view('#', compact('projetClients')); //a rediriger
    }


    public function create()
    {
        $clients = Client::all();

        return view('#', compact('clients')); //a rediriger
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nom_projet' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|in:en_attente,en_cours,termine',
        ]);

        ProjetClient::create($validated);

        return redirect()->route('#') //a rediriger
            ->with('success', 'Projet client ajouté avec succès.');
    }


    public function show(string $id)
    {
        $projetClient = ProjetClient::with('client')->findOrFail($id);

        return view('#', compact('projetClient')); //a rediriger
    }


    public function edit(string $id)
    {
        $projetClient = ProjetClient::findOrFail($id);
        $clients = Client::all();

        return view('#', compact('projetClient', 'clients')); //a rediriger
    }


    public function update(Request $request, string $id)
    {
        $projetClient = ProjetClient::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'nom_projet' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|in:en_attente,en_cours,termine',
        ]);

        $projetClient->update($validated);

        return redirect()->route('#'); //a rediriger
    }


    public function destroy(string $id)
    {
        $projetClient = ProjetClient::findOrFail($id);

        $projetClient->delete();

        return redirect()->route('#'); //a rediriger
    }
}
