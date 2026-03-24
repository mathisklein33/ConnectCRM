<?php

namespace App\Http\Controllers;

use App\Models\Quotes;
use App\Models\Client;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quotes::with('client')->get();

        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();

        return view('quotes.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255|unique:quotes,number',
            'title' => 'required|string|max:255',
            'total' => 'required|numeric',
            'status' => 'nullable|string|max:255',
        ]);

        $quote = Quotes::create($validated);

        return redirect()->route('quotes.index', $quote->id); // a rediriger
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quote = Quotes::with('client')->findOrFail($id);

        return view('quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quote = Quotes::findOrFail($id);
        $clients = Client::all();

        return view('quotes.edit', compact('quote', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quote = Quotes::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'number' => 'required|string|max:255|unique:quotes,number,' . $id,
            'title' => 'required|string|max:255',
            'total' => 'required|numeric',
            'status' => 'nullable|string|max:255',
        ]);

        $quote->update($validated);

        return redirect()->route('#', $quote->id); // a rediriger
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quote = Quotes::findOrFail($id);

        $quote->delete();

        return redirect()->route('#'); // a rediriger
    }
}
