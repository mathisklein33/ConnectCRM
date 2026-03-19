@extends('layouts.app')

@section('content')
    <div class="interaction-container">
        <div class="interaction-header-actions">
            <a href="{{ route('interactions.index') }}" class="back-link">← Retour à la liste</a>
            <h1 class="interaction-title">Détail de l'interaction</h1>
        </div>

        <div class="interaction-card">
            <div class="card-header">
                <div class="client-info">
                    <span class="label">Client</span>
                    <h2 class="client-name">{{ $interaction->client->nom }}</h2>
                </div>
                <div class="interaction-badge">
                 <span class="badge-type type-{{ Str::slug($interaction->type) }}">
                    <span class="dot"></span>
                    {{ $interaction->type }}
                </span>
                </div>
            </div>

            <hr class="divider">

            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Date de l'échange</span>
                        <p class="value">{{ \Carbon\Carbon::parse($interaction->date)->format('d F Y') }}</p>
                    </div>
                    <div class="info-item">
                        <span class="label">Sujet</span>
                        <p class="value">{{ $interaction->sujet ?? 'Sans sujet spécifié' }}</p>
                    </div>
                </div>

                <div class="content-section">
                    <span class="label">Notes / Contenu</span>
                    <div class="content-box">
                        {{ $interaction->contenu ?? 'Aucun détail supplémentaire pour cette interaction.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
