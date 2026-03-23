@extends('layouts.app')

@section('content')
    <div class="req-container">
        <div class="req-header">
            <h1 class="req-title">Nouvelle Demande</h1>
            <p class="req-subtitle">Remplissez les détails ci-dessous pour soumettre votre requête.</p>
        </div>

        <form action="#" method="POST" class="req-form">
            @csrf

            <div class="req-group">
                <label class="req-label">Type de demande</label>
                <select name="type" class="req-input" required>
                    <option value="">Sélectionnez un type...</option>
                    <option value="technique">Support Technique</option>
                    <option value="administratif">Administratif</option>
                    <option value="facturation">Facturation</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <div class="req-group">
                <label class="req-label">Sujet / Titre</label>
                <input type="text" name="subject" class="req-input" placeholder="Ex: Problème d'accès au serveur" required>
            </div>

            <div class="req-group">
                <label class="req-label">Priorité</label>
                <div class="req-radio-row">
                    <label class="req-radio-card">
                        <input type="radio" name="priority" value="basse" checked>
                        <span>Basse</span>
                    </label>
                    <label class="req-radio-card">
                        <input type="radio" name="priority" value="normale">
                        <span>Normale</span>
                    </label>
                    <label class="req-radio-card req-urgent">
                        <input type="radio" name="priority" value="haute">
                        <span>Haute</span>
                    </label>
                </div>
            </div>

            <div class="req-group">
                <label class="req-label">Description détaillée</label>
                <textarea name="description" class="req-input req-textarea" rows="5" placeholder="Décrivez votre besoin en quelques lignes..." required></textarea>
            </div>

            <div class="req-footer">
                <a href="#" class="req-btn-cancel">Annuler</a>
                <button type="submit" class="req-btn-submit">Envoyer la demande</button>
            </div>
        </form>
    </div>
@endsection
