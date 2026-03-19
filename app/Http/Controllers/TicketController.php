<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Client;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Afficher la liste des tickets.
     */
    public function index()
    {
        $tickets = Ticket::with('client')->get();

        return view('#', compact('tickets')); // a rediriger
    }

    /**
     * Afficher le formulaire de création d’un ticket.
     */
    public function create()
    {
        $clients = Client::all();

        return view('#', compact('clients')); // a rediriger
    }

    /**
     * Enregistrer un nouveau ticket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'client_email' => 'nullable|email|max:255',
            'client_telephone' => 'nullable|string|max:20',
            'name_ticket' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'valide' => 'nullable|boolean',
        ]);

        $validated['valide'] = $request->has('valide');

        Ticket::create($validated);

        return redirect()->route('#'); // a rediriger
    }

    /**
     * Afficher un ticket.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with('client')->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $clients = Client::all();

        return view('#', compact('ticket', 'clients')); // a rediriger
    }

    /**
     * Mettre à jour un ticket.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'client_email' => 'nullable|email|max:255',
            'client_telephone' => 'nullable|string|max:20',
            'name_ticket' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'valide' => 'nullable|boolean',
        ]);

        $validated['valide'] = $request->has('valide');

        $ticket->update($validated);

        return redirect()->route('#'); // a rediriger
    }

    /**
     * Supprimer un ticket.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->delete();

        return redirect()->route('#'); // a rediriger
    }
}
