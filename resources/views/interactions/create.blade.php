@extends('layouts.app')

@section('content')
    <div class="interaction-container small-container">
        <div class="interaction-header-actions">
            <a href="{{ '/interactions'}}" class="back-link">← Annuler</a>
        </div>

        <div class="interaction-card form-card">
            <div class="form-header">
                <h1 class="form-title">Nouvelle interaction</h1>
                <p class="form-subtitle">Enregistrement d'un échange avec <strong>{{ $client->name }}</strong></p>
            </div>

            <form method="POST" action="{{ route('interactions.store') }}" class="modern-form">
                @csrf
                <input type="hidden" name="client_id" value="{{ $client->id }}">

                <div class="form-group">
                    <label class="label">Moyen de contact</label>
                    <div class="type-selector">
                        <input type="radio" name="type" value="appel" id="type-appel" checked required>
                        <label for="type-appel" class="type-option">📞 Appel</label>

                        <input type="radio" name="type" value="email" id="type-email">
                        <label for="type-email" class="type-option">✉️ Email</label>

                        <input type="radio" name="type" value="rendez-vous" id="type-rdv">
                        <label for="type-rdv" class="type-option">🤝 RDV</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group flex-1">
                        <label class="label">Date de l'interaction</label>
                        <input type="date" name="date" class="form-input" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group flex-2">
                        <label class="label">Sujet de l'échange</label>
                        <input type="text" name="sujet" class="form-input" placeholder="Ex: Relance devis, Qualification..." required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label">Détails / Notes</label>
                    <textarea name="contenu" class="form-textarea" rows="5" placeholder="Que s'est-il dit durant cet échange ?"></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="interaction-btn btn-save">Enregistrer l'interaction</button>
                </div>
            </form>
        </div>
    </div>
@endsection
