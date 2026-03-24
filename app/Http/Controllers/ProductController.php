<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Product;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Liste des produits pour le catalogue du commercial
    public function index(Request $request)
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté
        $query = product::with(['client', 'user']);
        $opportunities = Opportunity::with('client')->get();
        // --- LOGIQUE DE VISIBILITÉ ---
        // Si l'utilisateur n'est PAS un chef d'équipe (on suppose que tu as un champ 'role' ou une méthode isAdmin())
        // Ici, j'utilise une vérification de rôle fictive : $user->role !== 'chef'
        if ($user->role !== 'chef') {
            $query->where('user_id', $user->id);
        }
        // Si c'est un chef, on lui permet d'utiliser le filtre par membre
        elseif ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filtre par Statut (accessible à tous pour leurs dossiers respectifs)
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->statut);
        }

        $products = $query->latest()->get();
        $users = User::all();

        return view('products.index', compact('products', 'users', 'opportunities'));
    }

    // Création d'un nouveau produit (réservé aux admins/chefs)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'base_price' => 'required|numeric',
            'category' => 'nullable|string'
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }
    public function show($id) {
        $product = Product::withCount('opportunities')->findOrFail($id);
        return view('products.show', compact('product'));
    }
    /**
     * Affiche le formulaire de modification d'un produit.
     */
    public function edit($id)
    {
        // 1. Récupérer le produit ou renvoyer une erreur 404 s'il n'existe pas
        $product = \App\Models\Product::findOrFail($id);

        // 2. Définir les catégories (pour que le chef d'équipe puisse choisir)
        // Optionnel : Vous pouvez aussi les stocker dans une table séparée en DB
        $categories = ['Logiciel', 'Matériel', 'Service', 'Formation'];

        // 3. Retourner la vue avec les données nécessaires
        return view('products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès !');
    }
}
