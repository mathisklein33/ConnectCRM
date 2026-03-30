@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5 px-5 home-page">

        <!-- HEADER -->
        <div class="card border-0 shadow-sm rounded-4 mb-5 welcome-card">
            <div class="card-body p-5">
                <div class="row align-items-center">

                    <div class="col-lg-8">
                        <h1 class="fw-bold mb-3 welcome-title">
                            Bonjour {{ Auth::user()->name ?? 'Utilisateur' }} 👋
                        </h1>

                        <p class="fs-5 text-muted mb-4">
                            Bienvenue sur <strong>ConnectCRM</strong>.
                            Retrouvez rapidement toutes les actions importantes.
                        </p>

                        <a href="{{ route('clients.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                            + Créer un client
                        </a>
                    </div>

                    <div class="col-lg-4 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                             class="welcome-img">
                    </div>

                </div>
            </div>
        </div>

        <!-- ETAPES -->
        <h3 class="text-center mb-5 section-title">Par quoi commencer ?</h3>

        <div class="row g-4 mb-5">

            @php
                $steps = [
                    ['img' => 'https://cdn-icons-png.flaticon.com/512/747/747376.png', 'title' => 'Ajouter un client', 'text' => 'Créer une fiche client.'],
                    ['img' => 'https://cdn-icons-png.flaticon.com/512/1828/1828919.png', 'title' => 'Suivre une opportunité', 'text' => 'Gérer vos ventes.'],
                    ['img' => 'https://cdn-icons-png.flaticon.com/512/2991/2991112.png', 'title' => 'Créer un document', 'text' => 'Devis, contrats, factures.'],
                    ['img' => 'https://cdn-icons-png.flaticon.com/512/190/190411.png', 'title' => 'Voir l’activité', 'text' => 'Analyser vos résultats.']
                ];
            @endphp

            @foreach($steps as $step)
                <div class="col-md-6 col-xl-3">
                    <div class="step-box text-center">

                        <img src="{{ $step['img'] }}" class="step-img mb-3">

                        <h5 class="fw-bold">{{ $step['title'] }}</h5>

                        <p class="text-muted mb-0">
                            {{ $step['text'] }}
                        </p>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="middle-dashboard-block mb-5">

            <!-- En-tête -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 middle-header-card">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                        <div>
                            <h3 class="fw-bold mb-1 middle-title">Votre espace de travail</h3>
                            <p class="text-muted mb-0">
                                Accédez rapidement à vos outils, à vos éléments récents et à vos modules principaux.
                            </p>
                        </div>

                        <div class="middle-search-box">
                            <input type="text" class="form-control middle-search-input"
                                   placeholder="Rechercher un module, un document ou une action...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blocs principaux -->
            <div class="row g-4 mb-4">

                <!-- Colonne gauche -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 middle-panel h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Accès rapides</h5>

                            <div class="d-grid gap-2">
                                <a href="{{ route('clients.create') }}" class="btn btn-primary rounded-pill">Créer un client</a>
                                <a href="{{ route('clients.index') }}" class="btn btn-outline-primary rounded-pill">Voir les clients</a>
                                <a href="{{ route('sales_statistics.index') }}" class="btn btn-outline-primary rounded-pill">Voir l’activité</a>
                            </div>

                            <hr class="my-4">

                            <h6 class="fw-bold mb-3">Raccourcis utiles</h6>

                            <ul class="list-unstyled middle-link-list mb-0">
                                <li><a href="{{ route('quotes.index') }}">Devis</a></li>
                                <li><a href="{{ route('contracts.index') }}">Contrats</a></li>
                                <li><a href="{{ route('invoices.index') }}">Factures</a></li>
                                <li><a href="{{ route('products.index') }}">Produits</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Colonne centre -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 middle-panel h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Pour vous</h5>

                            <div class="middle-mini-card mb-3">
                                <div class="fw-semibold">Clients</div>
                                <div class="text-muted small">Consulter et gérer les fiches clients.</div>
                            </div>

                            <div class="middle-mini-card mb-3">
                                <div class="fw-semibold">Demandes</div>
                                <div class="text-muted small">Suivre les demandes et leur traitement.</div>
                            </div>

                            <div class="middle-mini-card mb-3">
                                <div class="fw-semibold">Planning</div>
                                <div class="text-muted small">Voir les rendez-vous et horaires programmés.</div>
                            </div>

                            <div class="middle-mini-card">
                                <div class="fw-semibold">Tickets</div>
                                <div class="text-muted small">Retrouver les demandes d’assistance.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 middle-panel h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Actions disponibles</h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="action-tile">
                                        <div class="fw-semibold">Créer</div>
                                        <div class="text-muted small">Ajoutez rapidement un nouvel élément.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="action-tile">
                                        <div class="fw-semibold">Consulter</div>
                                        <div class="text-muted small">Accédez à vos données existantes.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="action-tile">
                                        <div class="fw-semibold">Suivre</div>
                                        <div class="text-muted small">Contrôlez l’avancement des actions en cours.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="action-tile">
                                        <div class="fw-semibold">Analyser</div>
                                        <div class="text-muted small">Consultez les indicateurs d’activité.</div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h6 class="fw-bold mb-3">Modules principaux</h6>

                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge middle-badge">Clients</span>
                                <span class="badge middle-badge">Contacts</span>
                                <span class="badge middle-badge">Demandes</span>
                                <span class="badge middle-badge">Produits</span>
                                <span class="badge middle-badge">Équipe</span>
                                <span class="badge middle-badge">Activité</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tableau bas -->
            <div class="card border-0 shadow-sm rounded-4 middle-table-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Vue d’ensemble</h5>

                    <div class="table-responsive">
                        <table class="table align-middle middle-table mb-0">
                            <thead>
                            <tr>
                                <th>Module</th>
                                <th>Description</th>
                                <th>Accès</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Clients</td>
                                <td>Gestion des fiches clients et de leurs informations.</td>
                                <td><a href="{{ route('clients.index') }}" class="table-link">Ouvrir</a></td>
                            </tr>
                            <tr>
                                <td>Devis</td>
                                <td>Préparation des propositions commerciales.</td>
                                <td><a href="{{ route('quotes.index') }}" class="table-link">Ouvrir</a></td>
                            </tr>
                            <tr>
                                <td>Produits</td>
                                <td>Consultation du catalogue de produits et services.</td>
                                <td><a href="{{ route('products.index') }}" class="table-link">Ouvrir</a></td>
                            </tr>
                            <tr>
                                <td>Activité</td>
                                <td>Suivi des performances et statistiques commerciales.</td>
                                <td><a href="{{ route('sales_statistics.index') }}" class="table-link">Ouvrir</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- ACTIONS -->
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">

            <h4 class="mb-3">Accès rapide</h4>

            <div class="d-flex flex-wrap justify-content-center gap-3">

                <a href="{{ route('clients.create') }}" class="btn btn-primary">Créer un client</a>
                <a href="{{ route('clients.index') }}" class="btn btn-outline-primary">Voir clients</a>
                <a href="{{ route('sales_statistics.index') }}" class="btn btn-outline-primary">Statistiques</a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Produits</a>

            </div>

        </div>

    </div>

    <style>
        .home-page {
            background: #f8fafc;
        }

        /* HEADER */
        .welcome-card {
            background: linear-gradient(135deg, #eef4ff, #f8fbff);
        }

        .welcome-img {
            width: 120px;
        }

        /* TITRES */
        .section-title {
            color: #1f3b64;
        }

        /* STEPS */
        .step-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            transition: 0.2s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .step-box:hover {
            transform: translateY(-5px);
        }

        .step-img {
            width: 60px;
        }

        /* MENU */
        .menu-card {
            border-radius: 16px;
            transition: 0.2s;
            padding: 15px;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .menu-img {
            width: 50px;
        }

        /* BOUTONS */
        .btn {
            border-radius: 999px;
            padding: 8px 18px;
        }

        .btn-primary {
            background: #2563eb;
            border: none;
        }
    </style>

@endsection
