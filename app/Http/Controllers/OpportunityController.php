<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Opportunity;
use App\Models\Product;
use App\Models\User;
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
    public function create()
    {
        $clients = Client::all();
        $users = User::all();
        $Products = Product::all();



        return view('opportunity.create', compact('clients', 'users', 'Products'));
    }


    /**
     * Créer une vente avec plusieurs produits liés
     */
// Assurez-vous d'avoir bien importé la classe en haut du fichier :
// use Illuminate\Http\Request;

    public function store(Request $request) // <-- C'est ici qu'on définit $request
    {
        // Votre validation
        $validated = $request->validate([
            'title' => 'required|string',
            'client_id' => 'required|integer',
            'expected_closing_date' => 'required|date',
        ]);

        // Votre création d'opportunité
        $opportunity = Opportunity::create([
            'title' => $request->title,
            'client_id' => $request->client_id,
            'user_id' => auth()->id(),
            'stage' => $request->stage,
            'probability' => $request->probability,
            'expected_closing_date' => $request->expected_closing_date,
        ]);

        // 2. Attacher les produits (C'est ici que l'erreur se produit souvent)
        // On vérifie si $request->products existe bien
        if ($request->has('products')) {
            foreach ($request->products as $index => $productId) {
                $opportunity->products()->attach($productId, [
                    'quantity'   => $request->quantities[$index],
                    'unit_price' => $request->prices[$index],
                ]);
            }
        }

        return redirect()->route('products.index');
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
    public function edit($id)
    {
        $opportunity = Opportunity::with(['client', 'user'])->findOrFail($id);
        $clients = Client::all();
        $users = User::all();
        $Products = Product::all();
        return view('opportunity.edit', compact('opportunity','clients', 'users', 'Products'));
    }

    public function update(Request $request, $id)
    {
        $opportunity = Opportunity::findOrFail($id);

        // Validation
        $validated = $request->validate([
            'title' => 'required|string',
            'client_id' => 'required|integer',
            'stage' => 'required|string',
            'probability' => 'required|numeric|min:0|max:100',
            'expected_closing_date' => 'required|date',
        ]);

        // Mettre à jour l'opportunité
        $opportunity->update([
            'title' => $request->title,
            'client_id' => $request->client_id,
            'stage' => $request->stage,
            'probability' => $request->probability,
            'expected_closing_date' => $request->expected_closing_date,
        ]);

        // Mettre à jour les produits liés
        if ($request->has('products')) {
            $syncData = [];
            foreach ($request->products as $index => $productId) {
                $syncData[$productId] = [
                    'quantity' => $request->quantities[$index] ?? 1,
                    'unit_price' => $request->prices[$index] ?? 0,
                ];
            }
            $opportunity->products()->sync($syncData);
        } else {
            // Si aucun produit sélectionné, détacher tous les produits
            $opportunity->products()->detach();
        }

        return redirect()->route('opportunity.show', $opportunity->id)
                         ->with('success', 'Opportunité mise à jour avec succès');
    }

}
