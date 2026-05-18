@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/crm-details.css') }}">

    <div class="dmd-wrapper">
        {{-- Header --}}
        <div class="dmd-header">
            <div>
                <a href="{{ route('products.index') }}" class="dmd-back-link">← Retour au tableau de bord</a>
                <h1 class="dmd-page-title">{{ $opportunity->title }}</h1>
                <p class="dmd-subtitle">Détails de l'opportunité #{{ $opportunity->id }}</p>
            </div>
            <div class="dmd-actions-top">
                <a href="{{ route('opportunity.edit', $opportunity->id) }}" class="dmd-btn-create btn-warning">Modifier le deal</a>
            </div>
        </div>

        <div class="dmd-container">

            {{-- GAUCHE : Client & Produits --}}
            <div class="dmd-main-col">
                <div class="dmd-details-card">
                    <h3 class="dmd-section-title">Informations Générales</h3>
                    <div class="dmd-info-grid">
                        <div>
                            <span class="dmd-info-label">Client</span>
                            <p class="dmd-info-value">{{ $opportunity->client?->company_name ?? 'Inconnu' }}</p>
                        </div>
                        <div>
                            <span class="dmd-info-label">Commercial en charge</span>
                            <p class="dmd-info-value">{{ $opportunity->user?->name ?? 'Non assigné' }}</p>
                        </div>
                    </div>
                </div>

                <div class="dmd-details-card">
                    <h3 class="dmd-section-title">Produits inclus</h3>
                    <table class="dmd-table">
                        <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Qté</th>
                            <th>Prix Unit.</th>
                            <th class="text-right">Total HT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $totalOp = 0; @endphp
                        @foreach($opportunity->products as $product)
                            @php
                                $st = $product->pivot->quantity * $product->pivot->unit_price;
                                $totalOp += $st;
                            @endphp
                            <tr>
                                <td><strong>{{ $product->name }}</strong><br><small>{{ $product->sku }}</small></td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ number_format($product->pivot->unit_price, 2, ',', ' ') }} €</td>
                                <td class="text-right"><strong>{{ number_format($st, 2, ',', ' ') }} €</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="dmd-total-row">
                            <td colspan="3" class="text-right">TOTAL DE L'OPPORTUNITÉ :</td>
                            <td class="text-right dmd-total-price">{{ number_format($totalOp, 2, ',', ' ') }} €</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- DROITE : État & Pilotage --}}
            <div class="dmd-side-col">
                <div class="dmd-details-card">
                    <h3 class="dmd-section-title">Pilotage</h3>

                    <div style="margin-bottom: 20px;">
                        <span class="dmd-info-label">Étape actuelle</span>
                        <span class="dmd-badge dmd-badge-{{ Str::slug($opportunity->stage) }}">
                        {{ $opportunity->stage }}
                    </span>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <span class="dmd-info-label">Probabilité ({{ $opportunity->probability }}%)</span>
                        <div class="dmd-progress-container">
                            <div class="dmd-progress-fill" style="width: {{ $opportunity->probability }}%;"></div>
                        </div>
                    </div>

                    <div class="dmd-side-footer">
                        <span class="dmd-info-label">Clôture estimée (Schedules)</span>
                        <p class="dmd-date-critical">{{ \Carbon\Carbon::parse($opportunity->expected_closing_date)->format('d/m/Y') }}</p>

                        <span class="dmd-info-label">Dernière mise à jour</span>
                        <p>{{ $opportunity->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
