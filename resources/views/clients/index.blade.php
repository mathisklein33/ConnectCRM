@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h1 class="h3 mb-0">Répertoire Clients</h1>
            <a href="{{route('interactions.index')}}" class="btn btn-outline-primary">
                <i class="bi bi-list-check"></i> Voir toutes les interactions
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="card border-0 shadow-sm">
            <div class="list-group list-group-flush">
                @forelse($clients as $client)
                    <div class="list-group-item p-3">
                        <div class="row align-items-center g-3">

                            <div class="col-auto d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <strong>{{ strtoupper(substr($client->name, 0, 1)) }}</strong>
                                </div>
                            </div>

                            <div class="col-12 col-md">
                                <h6 class="mb-0 text-dark">{{ $client->name }}</h6>
                                <small class="text-muted">{{ $client->email }}</small>
                            </div>

                            <div class="col-12 col-md text-md-center">
                            <span class="badge bg-light text-dark border">
                                {{ $client->entreprise ?: 'Particulier' }}
                            </span>
                            </div>

                            <div class="col-12 col-lg-auto">
                                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-light border" title="Voir le profil">
                                        👤 <span class="d-lg-none d-xl-inline">Profil</span>
                                    </a>
                                    <a href="/interactions/client/{{$client->id}}" class="btn btn-sm btn-light border" title="Historique">
                                        🕒 <span class="d-lg-none d-xl-inline">Historique</span>
                                    </a>
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-light border" title="Historique">
                                        ⚙️ <span class="d-lg-none d-xl-inline">Éditer</span>
                                    </a>
                                    <a href="{{ route('interactions.create', $client->id) }}" class="btn btn-sm btn-primary" title="Ajouter">
                                        + <span class="d-lg-none d-xl-inline">Interaction</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="list-group-item text-center py-5 text-muted">
                        Aucun client trouvé.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
