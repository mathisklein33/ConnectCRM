@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <a href="/clients" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> ← Retour aux clients
            </a>
            <a href="/interactions/create/{{$client->id}}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg"></i> + Nouvelle Interaction
            </a>
        </div>

        <div class="row g-4">
            <aside class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body text-center p-4">
                        <div class="mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </div>

                        <h2 class="h4 mb-1">{{ $client->name }}</h2>
                        <span class="badge rounded-pill bg-soft-info text-primary mb-4 px-3 py-2 border border-primary">
                        {{ $client->status ?? 'Client' }}
                    </span>

                        <hr class="text-muted opacity-25">

                        <div class="text-start">
                            <div class="mb-3">
                                <label class="small text-muted text-uppercase fw-bold">Email</label>
                                <p class="mb-0 text-break">{{ $client->email ?? 'Non renseigné' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted text-uppercase fw-bold">Téléphone</label>
                                <p class="mb-0">{{ $client->telephone ?? 'Non renseigné' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted text-uppercase fw-bold">Entreprise & Profession</label>
                                <p class="mb-0">
                                    <strong>{{ $client->entreprise }}</strong><br>
                                    <small class="text-muted">{{ $client->profession }}</small>
                                </p>
                            </div>
                            <div class="mb-0">
                                <label class="small text-muted text-uppercase fw-bold">Adresse</label>
                                <p class="mb-0 small">{{ $client->adresse ?? 'Non renseigné' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="col-12 col-lg-8">
                <div class="card border-0 bg-transparent">
                    <div class="card-body p-0">
                        <h3 class="h4 fw-bold mb-4">Historique des échanges</h3>

                        <div class="position-relative ps-4 ms-2 border-start border-2 border-primary-subtle">

                            @forelse($interactions as $interaction)
                                <div class="mb-5 position-relative">

                                    <div class="position-absolute rounded-circle bg-white border border-primary border-3"
                                         style="width: 16px; height: 16px; left: -34px; top: 4px;"></div>

                                    <div class="mb-2">
                        <span class="text-muted fw-bold small">
                            {{ \Carbon\Carbon::parse($interaction->date)->format('d M') }}
                        </span>
                                    </div>

                                    <div class="card border-0 rounded-4 bg-light shadow-none p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            @php
                                                $badgeColor = match(Str::slug($interaction->type)) {
                                                    'appel' => 'primary',
                                                    'email' => 'success',
                                                    'rendez-vous' => 'warning',
                                                    default => 'secondary'
                                                };
                                            @endphp
                                            <span class="badge rounded-pill px-3 py-2 bg-{{ $badgeColor }}-subtle text-{{ $badgeColor }} border-0">
                                {{ $interaction->type }}
                            </span>

                                            <a href="{{ route('interactions.show', $interaction->id) }}" class="text-decoration-none small fw-bold text-primary">
                                                Voir détails →
                                            </a>
                                        </div>

                                        <h4 class="h5 fw-bold mb-1">{{ $interaction->sujet ?? 'Sans sujet' }}</h4>
                                        <p class="text-muted mb-0 small">
                                            {{ $interaction->contenu }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Aucun historique pour ce client.</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
