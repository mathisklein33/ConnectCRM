@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/crm-details.css') }}">

    <div class="dmd-wrapper">
        {{-- Header --}}
        <div class="dmd-header">
            <div>
                <a href="{{ route('products.index') }}" class="dmd-back-link">← Retour au catalogue</a>
                <h1 class="dmd-page-title">{{ $product->name }}</h1>
                <p class="dmd-subtitle">Fiche technique du produit #{{ $product->id }}</p>
            </div>
            <div class="dmd-actions-top">
                <a href="{{ route('products.edit', $product->id) }}" class="dmd-btn-create" style="background-color: #f59e0b;">Modifier le produit</a>
            </div>
        </div>

        <div class="dmd-container">

            {{-- GAUCHE : Détails du produit --}}
            <div class="dmd-main-col">
                <div class="dmd-details-card">
                    <h3 class="dmd-section-title">📦 Caractéristiques du produit</h3>
                    <div class="dmd-info-grid">
                        <div>
                            <span class="dmd-info-label">Référence (SKU)</span>
                            <p class="dmd-info-value">{{ $product->sku }}</p>
                        </div>
                        <div>
                            <span class="dmd-info-label">Catégorie</span>
                            <p class="dmd-info-value">
                            <span class="dmd-badge dmd-badge-{{ Str::slug($product->category) }}">
                                {{ $product->category }}
                            </span>
                            </p>
                        </div>
                        <div style="margin-top: 20px;">
                            <span class="dmd-info-label">Prix Catalogue</span>
                            <p class="dmd-info-value" style="font-size: 1.5rem; color: #6366f1;">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </p>
                        </div>
                        <div style="margin-top: 20px;">
                            <span class="dmd-info-label">Stock disponible</span>
                            <p class="dmd-info-value">{{ $product->quantity }} unités</p>
                        </div>
                    </div>
                </div>

                <div class="dmd-details-card">
                    <h3 class="dmd-section-title">📝 Description</h3>
                    <p style="color: #475569; line-height: 1.6;">
                        {{ $product->description ?? 'Aucune description disponible pour ce produit.' }}
                    </p>
                </div>
            </div>

            {{-- DROITE : État & Historique --}}
            <div class="dmd-side-col">
                <div class="dmd-details-card">
                    <h3 class="dmd-section-title">📊 Statut de vente</h3>

                    <div style="margin-bottom: 20px;">
                        <span class="dmd-info-label">Visibilité</span>
                        @if($product->is_active)
                            <span style="color: #10b981; font-weight: 600;">● Actif (En vente)</span>
                        @else
                            <span style="color: #ef4444; font-weight: 600;">○ Inactif (Hors catalogue)</span>
                        @endif
                    </div>

                    <div class="dmd-side-footer">
                        <span class="dmd-info-label">📅 Ajouté le</span>
                        <p>{{ $product->created_at->format('d/m/Y à H:i') }}</p>

                        <span class="dmd-info-label">⏱️ Dernière modification (Schedules)</span>
                        <p>{{ $product->updated_at->diffForHumans() }}</p>
                    </div>
                </div>

                {{-- Widget rapide pour le Chef d'Équipe --}}
                <div class="dmd-details-card" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                    <h4 style="font-size: 0.9rem; margin-bottom: 10px; color: #64748b;">Analyse Performance</h4>
                    <p style="font-size: 0.85rem; color: #475569;">
                        Ce produit apparaît dans <strong>{{ $product->opportunities_count ?? 0 }}</strong> opportunités en cours.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
