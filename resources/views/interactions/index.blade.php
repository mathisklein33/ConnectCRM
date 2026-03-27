@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h1 class="h3 mb-0 fw-bold text-dark">Liste des interactions</h1>
            <a href="/clients" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-people"></i> Voir tous les clients
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('interactions.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-auto">
                <label for="type" class="form-label small fw-bold text-muted text-uppercase">Filtrer par type</label>
                <select name="type" id="type" onchange="this.form.submit()" class="form-select shadow-sm">
                    <option value="">Tous les types</option>
                    @foreach($interactions->pluck('type')->unique() as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(request('type'))
                <div class="col-auto">
                    <div class="form-check form-switch pt-4">
                        <input class="form-check-input" type="checkbox" name="en_cours" id="en_cours"
                               {{ request('en_cours') ? 'checked' : '' }} onchange="this.form.submit()">
                        <label class="form-check-label small fw-bold text-muted" for="en_cours">Schedules à venir</label>
                    </div>
                    <a href="{{ route('interactions.index') }}" class="btn btn-link btn-sm text-danger text-decoration-none">
                        <i class="bi bi-x-circle"></i> Effacer le filtre
                    </a>
                </div>
            @endif
        </form>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th class="ps-4" style="width: 40px;"><input type="checkbox" class="form-check-input"></th>
                        <th class="text-muted small text-uppercase fw-bold">Client</th>
                        <th class="text-muted small text-uppercase fw-bold text-center">Type</th>
                        <th class="text-muted small text-uppercase fw-bold">Sujet</th>
                        <th class="text-muted small text-uppercase fw-bold">Statut</th>
                        <th class="text-muted small text-uppercase fw-bold">Date</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($interactions as $interaction)
                        <tr style="cursor: pointer;" onclick="window.location='{{ route('interactions.show', $interaction->id) }}'">
                            <td class="ps-4">
                                <input type="checkbox" class="form-check-input" onclick="event.stopPropagation();">
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $interaction->client->name }}</div>
                            </td>
                            <td class="text-center">
                                @php
                                    $color = match(Str::slug($interaction->type)) {
                                        'appel' => 'primary',
                                        'email' => 'success',
                                        'rendez-vous' => 'warning',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge rounded-pill bg-{{ $color }}-subtle text-{{ $color }} px-3 py-2 border-0">
                                    <span class="d-inline-block bg-{{ $color }} rounded-circle me-1" style="width: 6px; height: 6px;"></span>
                                    {{ $interaction->type ?? 'Inconnu' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">{{ Str::limit($interaction->sujet, 40) ?? 'Sans sujet' }}</span>
                            </td>
                            <td>
                                @php
                                    $statutColor = match($interaction->statut) {
                                        'planifie' => 'info',
                                        'realise'  => 'success',
                                        'annule'   => 'danger',
                                        default    => 'secondary'
                                    };

                                    // Alerte si le rdv est passé mais toujours marqué comme "planifié"
                                    $isOverdue = \Carbon\Carbon::parse($interaction->date)->isPast() && $interaction->statut === 'planifie';
                                @endphp
                                <span class="badge bg-{{ $statutColor }} {{ $isOverdue ? 'border border-warning' : '' }}">
        {{ ucfirst($interaction->statut) }}
    </span>
                                @if($isOverdue)
                                    <i class="bi bi-exclamation-triangle-fill text-warning" title="À mettre à jour"></i>
                                @endif
                            </td>
                            <td>
                                <span class="text-dark small fw-medium">
                                    {{ \Carbon\Carbon::parse($interaction->date)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('interactions.show', $interaction->id) }}" class="btn btn-sm btn-light border text-primary fw-bold">
                                    Voir →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Aucune interaction trouvée.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
