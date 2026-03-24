<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\Client;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contracts::with('client')->get();

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();

        return view('contracts.create', compact('clients')); // a rediriger
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255|unique:contracts,number',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'total' => 'required|numeric',
        ]);

        $contract = Contracts::create($validated);

        return redirect()->route('contracts.show', $contract->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contract = Contracts::with('client')->findOrFail($id);

        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contract = Contracts::findOrFail($id);
        $clients = Client::all();

        return view('contracts.edit', compact('contract', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contract = Contracts::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255|unique:contracts,number,' . $id,
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $contract->update($validated);

        return redirect()->route('#', $contract->id); // a rediriger
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contract = Contracts::findOrFail($id);

        $contract->delete();

        return redirect()->route('contracts.index');
    }
}
