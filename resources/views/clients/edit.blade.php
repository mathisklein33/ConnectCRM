@extends('layouts.app')

@section('content')
    <div class="client-form-container">
        <h1>Modifier le client : {{ $client->name }}</h1>

        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="form-group">
                <label class="form-label">Nom complet</label>
                <input type="text" name="name" class="client-input" required
                       value="{{ old('name', $client->name) }}" placeholder="Ex: Jean Dupont">
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email professionnel</label>
                <input type="email" name="email" class="client-input" required
                       value="{{ old('email', $client->email) }}" placeholder="jean@entreprise.fr">
                @error('email') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Genre</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="genre" value="homme" {{ old('genre', $client->genre) == 'homme' ? 'checked' : '' }}> Homme
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="genre" value="femme" {{ old('genre', $client->genre) == 'femme' ? 'checked' : '' }}> Femme
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="genre" value="autre" {{ old('genre', $client->genre) == 'autre' ? 'checked' : '' }}> Autre
                    </label>
                </div>
                @error('genre') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="client-input" required
                       value="{{ old('adresse', $client->adresse) }}" placeholder="12 rue des Fleurs">
                @error('adresse') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Ville</label>
                    <input type="text" name="ville" class="client-input" required
                           value="{{ old('ville', $client->ville) }}" placeholder="Paris">
                    @error('ville') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Code postal</label>
                    <input type="text" name="code_postal" class="client-input" required
                           value="{{ old('code_postal', $client->code_postal) }}" placeholder="75000">
                    @error('code_postal') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Entreprise</label>
                    <input type="text" name="entreprise" class="client-input"
                           value="{{ old('entreprise', $client->entreprise) }}" placeholder="Nom de la société">
                    @error('entreprise') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="telephone" class="client-input"
                           value="{{ old('telephone', $client->telephone) }}" placeholder="06XXXXXXXX">
                    @error('telephone') <div class="error-msg">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-actions" style="margin-top: 20px; display: flex; gap: 10px;">
                <button type="submit" class="btn-submit">Enregistrer les modifications</button>
                <a href="{{ route('clients.index') }}" class="btn-cancel" style="text-decoration: none; color: #666; padding: 10px;">Annuler</a>
            </div>
        </form>
    </div>
@endsection
