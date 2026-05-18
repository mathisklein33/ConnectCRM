@extends('layouts.app')

@section('content')
    <div class="interaction-container small-container">
        <div class="interaction-header-actions">
            <a href="{{ route('interactions.show', $interaction->id) }}" class="back-link">← Annuler</a>
        </div>

        <div class="interaction-card form-card">
            <div class="form-header">
                <h1 class="form-title">Modifier le schedules</h1>
                <p class="form-subtitle">Mise à jour de l'échange avec <strong>{{ $client->name }}</strong></p>
            </div>

            <form method="POST" action="{{ route('interactions.update', $interaction->id) }}" class="modern-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="label">État du schedules</label>
                    <div class="type-selector">
                        <input type="radio" name="statut" value="planifie" id="statut-planifie" {{ $interaction->statut == 'planifie' ? 'checked' : '' }} required>
                        <label for="statut-planifie" class="type-option">📅 À planifier</label>

                        <input type="radio" name="statut" value="realise" id="statut-realise" {{ $interaction->statut == 'realise' ? 'checked' : '' }}>
                        <label for="statut-realise" class="type-option">✅ Déjà réalisé</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label">Moyen de contact</label>
                    <div class="type-selector">
                        <input type="radio" name="type" value="appel" id="type-appel" {{ $interaction->type == 'appel' ? 'checked' : '' }} required>
                        <label for="type-appel" class="type-option">📞 Appel</label>

                        <input type="radio" name="type" value="email" id="type-email" {{ $interaction->type == 'email' ? 'checked' : '' }}>
                        <label for="type-email" class="type-option">✉️ Email</label>

                        <input type="radio" name="type" value="rendez-vous" id="type-rdv" {{ $interaction->type == 'rendez-vous' ? 'checked' : '' }}>
                        <label for="type-rdv" class="type-option">🤝 RDV</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group flex-1">
                        <label class="label">Date du schedules</label>
                        <input type="date" name="date" class="form-input" value="{{ ($interaction->date)->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group flex-2">
                        <label class="label">Sujet de l'échange</label>
                        <input type="text" name="sujet" class="form-input" value="{{ $interaction->sujet }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label">Détails / Notes (Compte-rendu)</label>
                    <textarea name="contenu" class="form-textarea" rows="8" placeholder="Inscrivez ici le résumé de l'échange une fois terminé...">{{ $interaction->contenu }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="interaction-btn btn-save">Mettre à jour le schedules</button>
                </div>
            </form>
        </div>
    </div>
@endsection
