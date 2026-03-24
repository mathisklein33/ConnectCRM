<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Client;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoices::with('client')->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();

        return view('invoices.create', compact('clients')); // a rediriger
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255|unique:invoices,number',
            'total' => 'required|numeric',
            'status' => 'nullable|string|max:255',
        ]);

        $invoice = Invoices::create($validated);

        return redirect()->route('#', $invoice->id); // a rediriger
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoices::with('client')->findOrFail($id);

        return view('#', compact('invoice')); // a rediriger
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoices::findOrFail($id);
        $clients = Client::all();

        return view('#', compact('invoice', 'clients')); // a rediriger
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoices::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255|unique:invoices,number,' . $id,
            'total' => 'required|numeric',
            'status' => 'nullable|string|max:255',
        ]);

        $invoice->update($validated);

        return redirect()->route('#', $invoice->id); // a rediriger
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoices::findOrFail($id);

        $invoice->delete();

        return redirect()->route('#'); // a rediriger
    }
}
