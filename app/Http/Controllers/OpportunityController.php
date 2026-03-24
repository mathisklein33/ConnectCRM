<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpportunityController extends Controller
{
    /**
     * Vue pour le Chef d'Équipe : Suivre la progression de son équipe
     */
    public function teamIndex(Request $request)
    {
        // On récupère les opportunités liées au chef d'équipe connecté
        $opportunities = Opportunity::with(['products', 'client', 'user'])
            ->where('team_leader_id', auth()->id())
            ->when($request->stage, function ($query, $stage) {
                return $query->where('stage', $stage);
            })
            ->orderBy('expected_closing_date')
            ->get();

        return response()->json($opportunities);
    }
    public function show($id)
    {
        // On affiche aussi qui est en charge de la demande
        $opportunity = Opportunity::with(['client'])->findOrFail($id);
        return view('opportunity.show', compact('opportunity'));
    }


    /**
     * Créer une vente avec plusieurs produits liés
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'expected_closing_date' => 'required|date',
            'products' => 'required|array', // Liste d'IDs produits avec quantités
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'integer|min:1',
            'products.*.unit_price' => 'numeric' // Prix négocié
        ]);

        return DB::transaction(function () use ($validated) {
            // 1. Création de l'opportunité
            $opportunity = Opportunity::create([
                'title' => $validated['title'],
                'client_id' => $validated['client_id'],
                'user_id' => auth()->id(),
                'team_leader_id' => auth()->user()->leader_id, // Hiérarchie CRM
                'stage' => 'Qualification',
                'probability' => 10,
                'expected_closing_date' => $validated['expected_closing_date'],
            ]);

            // 2. Attacher les produits avec les données pivots (prix au moment de la vente)
            foreach ($validated['products'] as $item) {
                $opportunity->products()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }

            return response()->json($opportunity->load('products'), 201);
        });
    }

    /**
     * Mettre à jour l'étape du cycle (Progression)
     */
    public function updateStage(Request $request, Opportunity $opportunity)
    {
        $request->validate(['stage' => 'required|string']);

        $opportunity->update([
            'stage' => $request->stage,
            'updated_at' => now() // Important pour les rapports de stagnation
        ]);

        return response()->json(['message' => 'Progression mise à jour']);
    }
}
