@extends('layouts.app')

@section('content')
    <div class="client-form-container">
        <h1>Ajouter un nouveau client</h1>

        <form action="{{ route('clients.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nom complet</label>
                <input type="text" name="name" class="client-input" required placeholder="Ex: Jean Dupont">
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email professionnel</label>
                <input type="email" name="email" class="client-input" required placeholder="jean@entreprise.fr">
                @error('email') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Genre</label>
                <div class="radio-group">
                    <label class="radio-label"><input type="radio" name="genre" value="homme"> Homme</label>
                    <label class="radio-label"><input type="radio" name="genre" value="femme"> Femme</label>
                    <label class="radio-label"><input type="radio" name="genre" value="autre"> Autre</label>
                </div>
                @error('genre') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="client-input" required placeholder="12 rue des Fleurs">
                @error('adresse') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <input type="text" name="ville" class="client-input" required placeholder="Paris">
                    @error('ville') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Code postal</label>
                    <input type="text" name="code_postal" class="client-input" required placeholder="75000">
                    @error('code_postal') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Entreprise</label>
                    <input type="text" name="entreprise" class="client-input" placeholder="Nom de la société">
                    @error('entreprise') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="telephone" class="client-input" placeholder="06XXXXXXXX">
                    @error('telephone') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn-submit">Créer la fiche client</button>
        </form>
    </div>
@endsection
