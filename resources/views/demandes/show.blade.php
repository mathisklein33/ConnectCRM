@extends('layouts.app')

@section('content')
    <div class="dmd-view-wrapper">
        <div class="dmd-view-actions">
            <a href="{{ route('demandes.index') }}" class="dmd-view-btn-back">← Retour à la liste</a>
            <div class="dmd-view-group-btns">
                <a href="{{ route('demandes.assignation', $demande->id) }}" class="dmd-view-btn-assign">Modifier l'assignation</a>
                <a href="{{ route('demandes.edit', $demande->id) }}" class="dmd-view-btn-edit">Modifier la demande</a>
            </div>
        </div>

        <div class="dmd-view-layout">
            <div class="dmd-view-main">
                <div class="dmd-view-card">
                    <div class="dmd-view-section">
                    <span class="dmd-view-badge dmd-view-badge-{{ Str::slug($demande->statut) }}">
                        {{ $demande->statut }}
                    </span>
                        <h1 class="dmd-view-title">{{ $demande->sujet }}</h1>
                        <p class="dmd-view-meta">Postée le {{ $demande->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    <div class="dmd-view-content">
                        <h3 class="dmd-view-section-title">Message du client</h3>
                        <div class="dmd-view-text">
                            {!! nl2br(e($demande->message)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <aside class="dmd-view-sidebar">
                <div class="dmd-view-card dmd-view-side-card">
                    <h3 class="dmd-view-side-title">Informations Client</h3>
                    <div class="dmd-view-info-item">
                        <span class="label">Nom :</span>
                        <span class="value">{{ $demande->client->name ?? 'Inconnu' }}</span>
                    </div>
                    <div class="dmd-view-info-item">
                        <span class="label">Contact :</span>
                        <span class="value"><a href="mailto:{{ $demande->email }}">{{ $demande->email }}</a></span>
                    </div>
                </div>

                <div class="dmd-view-card dmd-view-side-card">
                    <h3 class="dmd-view-side-title">Responsable</h3>
                    <div class="dmd-view-assignee">
                        @if($demande->user)
                            <div class="avatar">{{ substr($demande->user->name, 0, 1) }}</div>
                            <div class="details">
                                <span class="name">{{ $demande->user->name }}</span>
                                <span class="role">Membre de l'équipe</span>
                            </div>
                        @else
                            <p class="unassigned">Aucun membre assigné</p>
                            <a href="{{ route('demandes.assignation', $demande->id) }}" class="asgn-link">Assigner maintenant</a>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
