@extends('layouts.app')

@section('content')
    <div class="schedule-view-container">
        <h2 class="schedule-view-title">Détails du rendez-vous</h2>

        <div class="info-row">
            <div class="info-label">Titre</div>
            <div class="info-value">{{ $workSchedule->title }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Description</div>
            <div class="info-value">{{ $workSchedule->description ?? 'Aucune description' }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Équipe / Type</div>
            <div class="info-value">
            <span class="team-badge">
                {{ $workSchedule->team ? $workSchedule->team->name : 'Global (Entreprise)' }}
            </span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">Utilisateur</div>
            <div class="info-value">{{ $workSchedule->user ? $workSchedule->user->name : 'Non assigné' }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Date</div>
            <div class="info-value">{{ \Carbon\Carbon::parse($workSchedule->date)->format('d/m/Y') }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Heures</div>
            <div class="info-value">
                <strong>{{ $workSchedule->start_time }}</strong> à <strong>{{ $workSchedule->end_time }}</strong>
            </div>
        </div>

        <div class="schedule-actions">
            <a href="{{ route('schedules.index') }}" class="btn-schedule-secondary">Retour</a>

            <div style="flex-grow: 1;"></div> <a href="{{ route('schedules.edit', $workSchedule->id) }}" class="btn-schedule-primary">Modifier</a>

            <form action="{{ route('schedules.destroy', $workSchedule->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rendez-vous ?');" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger-outline">Supprimer</button>
            </form>
        </div>
    </div>
@endsection
