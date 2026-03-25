<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TicketController extends Controller
{
    /**
     * Afficher la liste des tickets.
     */
    public function index()
    {
        $tickets = Ticket::with(['client', 'user'])
            ->where('statut', 'ouvert')
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Afficher le formulaire de création d’un ticket.
     */
    public function create()
    {
        $clients = Client::all();

        return view('tickets.create', compact('clients')); // a rediriger
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
            'date_ticket' => 'required|date',
            'statut' => 'nullable|boolean',
        ]);

        $validated['valide'] = $request->has('valide');

        Ticket::create($validated);

        return redirect()->route('tickets.store'); // a rediriger
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

        return view('tickets.edit', compact('ticket', 'clients')); // a rediriger
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
            'date_ticket' => 'required|date',
            'valide' => 'nullable|boolean',
        ]);

        $validated['valide'] = $request->has('valide');

        $ticket->update($validated);

        return redirect()->route('tickets.index'); // a rediriger
    }

    /**
     * Supprimer un ticket.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->delete();

        return redirect()->route('tickets.index');
    }



    public function take(Ticket $ticket)
    {
        if ($ticket->statut !== 'ouvert') {
            return redirect()->back()->with('error', 'Ce ticket n’est plus disponible.');
        }

        $ticket->statut = 'en_cours';
        $ticket->user_id = Auth::id();
        $ticket->save();

        return redirect()->route('tickets.mine')->with('success', 'Ticket pris en charge.');
    }
    public function resolve(Ticket $ticket)
    {
        // Vérifie que l'utilisateur est bien assigné
        if ($ticket->user_id !== Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas fermer ce ticket.');
        }

        $ticket->update([
            'statut' => 'ferme'
        ]);

        return back()->with('success', 'Ticket résolu.');
    }


    public function mesTickets()
    {
        $tickets = Ticket::with(['client', 'user'])
            ->where('user_id', Auth::id())
            ->where('statut', 'en_cours')
            ->get();

        return view('tickets.mes_tickets', compact('tickets'));
    }

    public function transfer(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas transférer ce ticket.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Le ticket a été transféré avec succès.');
    }

    public function historique()
    {
        $tickets = Ticket::with(['client', 'user'])
            ->where('statut', 'ferme')
            ->get();

        return view('tickets.historique', compact('tickets'));
    }
}
