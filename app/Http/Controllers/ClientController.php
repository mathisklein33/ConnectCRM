<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Interaction;


class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));//vue clients.index

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('#');// a rediriger
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'genre' => 'nullable|in:homme,femme,autre',
            'adresse' => 'nullable|string',
            'ville' => 'nullable|string',
            'code_postal' => 'nullable|string',
            'entreprise' => 'nullable|string',
            'telephone' => 'nullable|string',
        ]);

        Client::create($validated);

        return redirect()->route('#'); // a rediriger
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        $interactions = $client->interactions; // récupère toutes les interactions de ce client
        return view('clients.show', compact('client',  'interactions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);

        return view('#', compact('client')); // a rediriger
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'genre' => 'nullable|in:homme,femme,autre',
            'adresse' => 'nullable|string',
            'ville' => 'nullable|string',
            'code_postal' => 'nullable|string',
            'entreprise' => 'nullable|string',

            'telephone' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('#');// a rediriger
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->route('#');// a rediriger
    }
}
