@extends('layouts.app')

@section('content')
    <div class="dmd-view-wrapper">
        <div class="dmd-view-actions">
            <a href="{{ route('interactions.index') }}" class="dmd-view-btn-back">
                ← Retour au planning
            </a>
            <div class="dmd-view-group-btns">
                <a href="{{ route('interactions.edit', $interaction->id) }}" class="dmd-view-btn-edit">
                    Modifier l'event
                </a>
            </div>
        </div>

        <div class="dmd-view-layout">

            <div class="dmd-view-main">
                <div class="dmd-view-card">
                    @php
                        $statusClass = match($interaction->statut) {
                            'planifie' => 'dmd-view-badge-en-cours',
                            'realise'  => 'dmd-view-badge-termine',
                            'annule'   => 'dmd-view-badge-nouveau',
                            default    => ''
                        };
                        $isOverdue = \Carbon\Carbon::parse($interaction->date)->isPast() && $interaction->statut === 'planifie';
                    @endphp

                    <span class="dmd-view-badge {{ $statusClass }}">
                    {{ ucfirst($interaction->statut) }}
                </span>

                    @if($isOverdue)
                        <div class="dmd-alert dmd-alert-success" style="background: #fffbeb; color: #92400e; border-color: #fcd34d; margin-top: 1rem;">
                            ⚠️ Cet event est passé. N'oubliez pas d'ajouter un compte-rendu au planning.
                        </div>
                    @endif

                    <h1 class="dmd-view-title">{{ $interaction->sujet ?? 'Sans sujet spécifié' }}</h1>
                    <p class="dmd-view-meta">Référence Event #{{ $interaction->id }} — Créé le {{ $interaction->created_at->format('d/m/Y') }}</p>

                    <div style="margin-top: 2rem;">
                        <h3 class="dmd-view-section-title">Notes / Contenu de l'event</h3>
                        <div class="dmd-view-text">
                            {{ $interaction->contenu ?? $interaction->notes ?? 'Aucun détail supplémentaire pour cet event.' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="dmd-view-sidebar">
                <div class="dmd-view-card">
                    <h3 class="dmd-view-side-title">Client associé</h3>
                    <div class="dmd-view-assignee">
                        <div class="avatar">
                            {{ strtoupper(substr($interaction->client->name, 0, 2)) }}
                        </div>
                        <div>
                            <span class="name">{{ $interaction->client->name }}</span>
                            <span class="role">Fiche client</span>
                        </div>
                    </div>
                </div>

                <div class="dmd-view-card">
                    <h3 class="dmd-view-side-title">Détails du planning</h3>
                    <div class="dmd-view-info-item">
                        <span class="label">Type d'event :</span>
                        <span class="value">{{ ucfirst($interaction->type) }}</span>
                    </div>
                    <div class="dmd-view-info-item">
                        <span class="label">Date de l'échange :</span>
                        <span class="value">{{ \Carbon\Carbon::parse($interaction->date)->format('d F Y') }}</span>
                    </div>
                    <div class="dmd-view-info-item">
                        <span class="label">Heure :</span>
                        <span class="value">{{ \Carbon\Carbon::parse($interaction->date)->format('H:i') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
