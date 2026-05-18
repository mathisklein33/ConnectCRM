<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Quotes;

class OrdersController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['client', 'quote'])->latest()->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $clients = Client::all();
        $quotes = Quotes::where('status', 'accepted')->get();

        return view('orders.create', compact('clients', 'quotes'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quote_id' => 'nullable|exists:quotes,id',
            'number' => 'required|string',
            'total' => 'required|numeric',
        ]);

        $order = Order::create($validated);

        // Si lié à un devis → on le passe en "converted"
        if ($order->quote) {
            $order->quote->update([
                'status' => 'converted'
            ]);
        }

        return redirect()->route('orders.index', $order->id)
            ->with('success', 'Commande créée avec succès');
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = Order::with(['client', 'quote'])->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $clients = Client::all();
        $quotes = Quotes::all();

        return view('orders.edit', compact('order', 'clients', 'quotes'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quote_id' => 'nullable|exists:quotes,id',
            'number' => 'required|string',
            'total' => 'required|numeric',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Commande mise à jour');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Commande supprimée');
    }
}
