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
        $user = auth()->user();
        $users = User::all();

        // --- LOGIQUE POUR LES OPPORTUNITÉS (Elles ont un user_id) ---
        $oppQuery = Opportunity::with('client');

        if ($user->role !== 'chef') {
            $oppQuery->where('user_id', $user->id);
        } elseif ($request->filled('user_id')) {
            $oppQuery->where('user_id', $request->user_id);
        }

        // Filtre par étape (stage) pour les opportunités si présent dans la requête
        if ($request->filled('stage')) {
            $oppQuery->where('stage', $request->stage);
        }

        $opportunities = $oppQuery->latest()->get();

        // --- LOGIQUE POUR LES PRODUITS (Ils n'ont PAS de user_id) ---
        // On retire le ->with('user') et les filtres user_id qui causaient l'erreur
        $prodQuery = Product::query();

        if ($request->filled('categorie')) {
            // Note : attention, vous utilisiez $request->statut pour filtrer la catégorie
            $prodQuery->where('categorie', $request->categorie);
        }

        $products = $prodQuery->latest()->get();

        return view('products.index', compact('products', 'users', 'opportunities'));
    }
    public function create()
    {
        $clients = Client::all();
        $users = User::all();
        $Products = Product::all();



        return view('products.create', compact('clients', 'users', 'Products'));
    }
    // Création d'un nouveau produit (réservé aux admins/chefs)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric|min:0', // On valide 'price' ici...
            'category' => 'nullable|string'
        ]);

        $product = Product::create($validated);
        return redirect()->route('products.index', compact('product')); // a rediriger
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
