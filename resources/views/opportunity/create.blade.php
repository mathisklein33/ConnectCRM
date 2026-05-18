@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/crm-details.css') }}">

    <div class="dmd-wrapper">
        <form action="{{ route('opportunity.store') }}" method="POST">
            @csrf

            {{-- Header --}}
            <div class="dmd-header">
                <div>
                    <a href="{{ route('products.index') }}" class="dmd-back-link">← Annuler et retourner au tableau de bord</a>
                    <h1 class="dmd-page-title">Nouvelle Opportunité</h1>
                    <p class="dmd-subtitle">Saisissez les informations pour créer un nouveau deal</p>
                </div>
                <div class="dmd-actions-top">
                    <button type="submit" class="dmd-btn-create btn-primary">Enregistrer l'opportunité</button>
                </div>
            </div>

            <div class="dmd-container">


                {{-- GAUCHE : Client & Produits --}}
                <div class="dmd-main-col">
                    <div class="dmd-details-card">
                        <h3 class="dmd-section-title">Informations Générales</h3>
                        <div class="dmd-info-grid">
                            <div class="form-group">
                                <label class="dmd-info-label">Titre du deal</label>
                                <input type="text" name="title" class="form-control" placeholder="ex: Refonte Site Web" required>
                            </div>
                            <div class="form-group">
                                <label class="dmd-info-label">Client</label>
                                <select name="client_id" class="form-control" required>
                                    <option value="">Sélectionner un client...</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="dmd-details-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="dmd-section-title">Sélection des Produits</h3>
                            <button type="button" id="add-product" class="btn btn-sm btn-outline-secondary">+ Ajouter un produit</button>
                        </div>

                        <table class="dmd-table" id="products-table">
                            <thead>
                            <tr>
                                <th>Produit</th>
                                <th style="width: 100px;">Qté</th>
                                <th style="width: 150px;">Prix Unit. HT</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- DROITE : État & Pilotage --}}
                <div class="dmd-side-col">
                    <div class="dmd-details-card">
                        <h3 class="dmd-section-title">Pilotage</h3>

                        <div class="form-group mb-4">
                            <label class="dmd-info-label">Étape de vente</label>
                            <select name="stage" class="form-control">
                                <option value="Prospection">Prospection</option>
                                <option value="Qualification">Qualification</option>
                                <option value="Proposition">Proposition</option>
                                <option value="Négociation">Négociation</option>
                                <option value="Terminée">Terminée</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label class="dmd-info-label">Probabilité de succès (%)</label>
                            <input type="number" name="probability" class="form-control" min="0" max="100" value="10">
                        </div>

                        <div class="dmd-side-footer">
                            <div class="form-group">
                                <label class="dmd-info-label">Date de clôture estimée (Schedules)</label>
                                <input type="date" name="expected_closing_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    {{-- Petit script pour gérer l'ajout dynamique de lignes --}}
    <script>
        // 1. Ajouter une ligne
        document.getElementById('add-product').addEventListener('click', function() {
            const tbody = document.querySelector('#products-table tbody');
            const row = `
                <tr>
                    <td>
                        <select name="products[]" class="form-control product-select" required>
                            <option value="" data-price="0">Choisir...</option>
                            @foreach($Products as $p)
            {{-- On stocke le prix dans l'attribut data-price --}}
            <option value="{{ $p->id }}" data-price="{{ $p->price ?? $p->base_price }}">
                                    {{ $p->name }}
            </option>
@endforeach
            </select>
        </td>
        <td><input type="number" name="quantities[]" class="form-control" value="1" min="1"></td>
        <td>
{{-- On ajoute une classe price-field pour le cibler --}}
            <input type="number" name="prices[]" class="form-control price-field" step="0.01" placeholder="0.00">
        </td>
        <td class="text-right">
            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">✕</button>
        </td>
    </tr>`;
            tbody.insertAdjacentHTML('beforeend', row);
        });

        // 2. Écouter le changement de sélection de produit
        document.addEventListener('change', function(e) {
            // Si l'élément modifié est un select de produit
            if (e.target && e.target.classList.contains('product-select')) {
                const select = e.target;

                // On récupère l'option choisie
                const selectedOption = select.options[select.selectedIndex];

                // On extrait le prix de l'attribut data-price
                const price = selectedOption.getAttribute('data-price');

                // On trouve l'input "price" de la même ligne
                const row = select.closest('tr');
                const priceInput = row.querySelector('.price-field');

                // On met à jour la valeur
                if (priceInput) {
                    priceInput.value = price;
                }
            }
        });
    </script>
@endsection
