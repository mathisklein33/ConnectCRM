@extends('layouts.app')

@section('content')
    <div class="dmd-wrapper">
        <div class="dmd-header">
            <div>
                <h1 class="dmd-page-title">Tableau de Bord CRM</h1>
                <p class="dmd-subtitle">Gestion des produits et suivi des opportunités de vente</p>
            </div>
            <div class="dmd-actions-top">
                <a href="/produits/create" class="dmd-btn-create" style="margin-right: 10px;">+ Nouveau Produit</a>
                <a href="/opportunities/create" class="dmd-btn-create" style="background-color: #6366f1;">+ Nouvelle Opportunité</a>
            </div>
        </div>

        @if(session('success'))
            <div class="dmd-alert dmd-alert-success">{{ session('success') }}</div>
        @endif

        {{-- Barre de filtres --}}
        <div class="dmd-filter-bar">
            <form action="{{ route('products.index') }}" method="GET" class="dmd-filter-form">
                @if(auth()->user()->role === 'chef')
                    <div class="dmd-filter-group">
                        <label>Chef d'équipe :</label>
                        <select name="user_id" onchange="this.form.submit()">
                            <option value="">Tous les membres</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="dmd-filter-group">
                    <label>Filtrer par étape :</label>
                    <select name="stage" onchange="this.form.submit()">
                        <option value="">Toutes les étapes</option>
                        <option value="Qualification" {{ request('stage') == 'Qualification' ? 'selected' : '' }}>Qualification</option>
                        <option value="Proposition" {{ request('stage') == 'Proposition' ? 'selected' : '' }}>Proposition</option>
                        <option value="Négociation" {{ request('stage') == 'Négociation' ? 'selected' : '' }}>Négociation</option>
                        <option value="Gagné" {{ request('stage') == 'Gagné' ? 'selected' : '' }}>Gagné</option>
                        <option value="Perdu" {{ request('stage') == 'Perdu' ? 'selected' : '' }}>Perdu</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- TABLE 1 : OPPORTUNITÉS (Le cycle de vente de la capture) --}}
        <h3>Cycle de vente (Opportunités)</h3>
        <div class="dmd-card">
            <div class="dmd-table-responsive">
                <table class="dmd-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre du Deal</th>
                        <th>Étape</th>
                        <th>Probabilité</th>
                        <th>Clôture prévue</th>
                        <th>Client</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($opportunities as $opportunity)
                        <tr>
                            <td class="dmd-id">#{{ $opportunity->id }}</td>
                            <td>
                                <span style="font-weight: 600; color: #334155;">{{ Str::limit($opportunity->title, 40) }}</span>
                            </td>
                            <td>
                                <span class="dmd-badge dmd-badge-{{ Str::slug($opportunity->stage) }}">
                                    {{ $opportunity->stage }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="flex-grow: 1; background: #e2e8f0; height: 6px; border-radius: 3px; width: 60px;">
                                        <div style="background: #6366f1; width: {{ $opportunity->probability }}%; height: 100%; border-radius: 3px;"></div>
                                    </div>
                                    <small>{{ $opportunity->probability }}%</small>
                                </div>
                            </td>
                            <td class="dmd-date">
                                {{ \Carbon\Carbon::parse($opportunity->expected_closing_date)->format('d/m/Y') }}
                            </td>
                            <td>👤 {{ $opportunity->client?->name ?? 'Client inconnu' }}</td>
                            <td class="dmd-actions">
                                <a href="/opportunity/show/{{$opportunity->id}}" class="dmd-btn-icon">Détails</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="dmd-empty">Aucune opportunité trouvée.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABLE 2 : PRODUITS (Votre catalogue actuel) --}}
        <h3>Catalogue Produits</h3>
        <div class="dmd-card">
            <div class="dmd-table-responsive">
                <table class="dmd-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produit & Réf</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Date d'ajout</th>
                        <th>Statut</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="dmd-id">#{{ $product->id }}</td>
                            <td>
                                <div class="dmd-product-info">
                                    <span class="dmd-product-name" style="font-weight: bold;">{{ $product->name }}</span>
                                    <p class="dmd-sku" style="font-size: 0.8rem; color: #64748b;">Réf: {{ $product->sku }}</p>
                                </div>
                            </td>
                            <td><span class="dmd-price">{{ number_format($product->price, 2, ',', ' ') }} €</span></td>
                            <td>
                                <span class="dmd-badge dmd-badge-info">
                                    {{ $product->categorie ?? 'Standard' }}
                                </span>
                            </td>
                            <td class="dmd-date">{{ $product->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($product->is_active)
                                    <span style="color: #10b981;">● Actif</span>
                                @else
                                    <span style="color: #ef4444;">○ Inactif</span>
                                @endif
                            </td>
                            <td class="dmd-actions">
                                <a href="/products/show/{{$product->id}}" class="dmd-btn-icon">Voir</a>
                                <a href="/products/edit/{{$product->id}}" class="dmd-btn-icon">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="dmd-empty">Le catalogue est vide.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
