@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/crm-details.css') }}">

    <div class="dmd-wrapper">
        {{-- Header avec retour --}}
        <div class="dmd-header">
            <div>
                <a href="{{ route('products.index') }}" class="dmd-back-link">← Annuler et retourner au catalogue</a>
                <h1 class="dmd-page-title">Modifier : {{ $product->name }}</h1>
                <p class="dmd-subtitle">Mise à jour des informations du produit #{{ $product->id }}</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="dmd-alert dmd-alert-danger" style="background: #fef2f2; border: 1px solid #f87171; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="dmd-container">
                {{-- GAUCHE : Formulaire principal --}}
                <div class="dmd-main-col">
                    <div class="dmd-details-card">
                        <h3 class="dmd-section-title">📦 Informations de base</h3>

                        <div style="margin-bottom: 20px;">
                            <label class="dmd-info-label">Nom du produit</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                   class="dmd-input" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px;" required>
                        </div>

                        <div class="dmd-info-grid">
                            <div>
                                <label class="dmd-info-label">Référence (SKU)</label>
                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                                       class="dmd-input" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px;" required>
                            </div>
                            <div>
                                <label class="dmd-info-label">Catégorie</label>
                                <select name="categorie" class="dmd-input" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px;">
                                    <option value="Logiciel" {{ $product->category == 'Logiciel' ? 'selected' : '' }}>Logiciel</option>
                                    <option value="Matériel" {{ $product->category == 'Matériel' ? 'selected' : '' }}>Matériel</option>
                                    <option value="Service" {{ $product->category == 'Service' ? 'selected' : '' }}>Service</option>
                                    <option value="Formation" {{ $product->category == 'Formation' ? 'selected' : '' }}>Formation</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="dmd-details-card">
                        <h3 class="dmd-section-title">💰 Tarification et Stocks</h3>
                        <div class="dmd-info-grid">
                            <div>
                                <label class="dmd-info-label">Prix Catalogue (€)</label>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                       class="dmd-input" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px;" required>
                            </div>
                            <div>
                                <label class="dmd-info-label">Quantité en stock</label>
                                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                       class="dmd-input" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px;" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DROITE : État de visibilité et Actions --}}
                <div class="dmd-side-col">
                    <div class="dmd-details-card">
                        <h3 class="dmd-section-title">⚙️ Paramètres</h3>

                        <div style="margin-bottom: 25px;">
                            <label class="dmd-info-label">Statut du produit</label>
                            <div style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" id="is_active" {{ $product->is_active ? 'checked' : '' }} style="width: 20px; height: 20px;">
                                <label for="is_active" style="font-weight: 500; cursor: pointer;">Produit actif (en vente)</label>
                            </div>
                            <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 10px;">
                                Un produit inactif n'apparaîtra plus dans les nouvelles opportunités.
                            </p>
                        </div>

                        <div style="border-top: 1px solid #e2e8f0; padding-top: 20px;">
                            <button type="submit" class="dmd-btn-create" style="width: 100%; background-color: #6366f1; border: none; cursor: pointer; padding: 12px;">
                                Enregistrer les modifications
                            </button>
                            <p style="text-align: center; margin-top: 15px;">
                                <small style="color: #94a3b8;">Dernière modification : <br>{{ $product->updated_at->format('d/m/Y à H:i') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
