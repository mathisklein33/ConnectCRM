@extends('layouts.app')

@section('content')
    <div class="dmd-wrapper">
        <div class="dmd-header">
            <div>
                <h2 class="dmd-page-title">Planning des interactions</h2>
                <p class="dmd-subtitle">Suivi des events clients</p>
            </div>
            <a href="/clients" class="dmd-view-btn-assign">
                Voir tous les clients
            </a>
        </div>

        @if(session('success'))
            <div class="dmd-alert dmd-alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="dmd-filter-bar">
            <form action="{{ route('interactions.index') }}" method="GET" class="dmd-filter-form">
                <div class="dmd-filter-group">
                    <label for="type">Filtrer par type d'event</label>
                    <select name="type" id="type" onchange="this.form.submit()">
                        <option value="">Tous les types</option>
                        @foreach($interactions->pluck('type')->unique() as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="dmd-card">
            <table class="dmd-table">
                <thead>
                <tr>
                    <th>Client</th>
                    <th>Type d'event</th>
                    <th>Sujet</th>
                    <th>Statut du planning</th>
                    <th>Date</th>
                    <th style="text-align: right;">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($interactions as $item) {{-- Changé $interaction en $item pour éviter les conflits --}}
                <tr style="cursor: pointer;" onclick="window.location='{{ route('interactions.show', $item->id) }}'">
                    <td>
                        <div class="dmd-client-info">
                            <span class="dmd-client-name">{{ $item->client->name }}</span>
                            <span class="dmd-client-email">{{ $item->client->email ?? '' }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="dmd-subject" style="text-align: center;">{{ ucfirst($item->type) }}</span>
                    </td>
                    <td>
                        <p class="dmd-excerpt">{{ Str::limit($item->sujet, 40) ?? 'Sans sujet' }}</p>
                    </td>
                    <td>
                        @php
                            $statusClass = match($item->statut) {
                                'planifie' => 'dmd-badge-en-attente',
                                'realise'  => 'dmd-badge-traitee',
                                'annule'   => 'dmd-badge-refusee',
                                default    => ''
                            };
                        @endphp
                        <span class="dmd-badge {{ $statusClass }}">
                                {{ ucfirst($item->statut) }}
                            </span>
                    </td>
                    <td>
                        <div class="dmd-date">
                            {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}
                            <small>Event</small>
                        </div>
                    </td>
                    <td class="dmd-actions">
                        <a href="{{ route('interactions.show', $item->id) }}" class="asgn-link">
                            Voir event →
                        </a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="dmd-empty">Aucun event trouvé dans le planning.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
