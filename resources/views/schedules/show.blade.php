@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Détails du rendez-vous</h2>

        <div class="bg-white shadow rounded p-6">
            <div class="mb-4">
                <strong>Titre :</strong>
                <span>{{ $workSchedule->title }}</span>
            </div>

            <div class="mb-4">
                <strong>Description :</strong>
                <span>{{ $workSchedule->description ?? 'Aucune description' }}</span>
            </div>

            <div class="mb-4">
                <strong>Équipe / Type :</strong>
                <span>{{ $workSchedule->team ? $workSchedule->team->name : 'Global (Toute l\'entreprise)' }}</span>
            </div>

            <div class="mb-4">
                <strong>Utilisateur :</strong>
                <span>{{ $workSchedule->user ? $workSchedule->user->name : 'Non assigné' }}</span>
            </div>

            <div class="mb-4">
                <strong>Date :</strong>
                <span>{{ \Carbon\Carbon::parse($workSchedule->date)->format('d/m/Y') }}</span>
            </div>

            <div class="mb-4">
                <strong>Heure :</strong>
                <span>{{ $workSchedule->start_time }} - {{ $workSchedule->end_time }}</span>
            </div>

            <div class="flex mt-6 gap-3">
                <a href="{{ route('schedules.edit', $workSchedule->id) }}" class="btn-schedule-primary">Modifier</a>

                <form action="{{ route('schedules.destroy', $workSchedule->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rendez-vous ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-schedule-secondary">Supprimer</button>
                </form>

                <a href="{{ route('schedules.index') }}" class="btn-schedule-secondary">Retour</a>
            </div>
        </div>
    </div>

@endsection
