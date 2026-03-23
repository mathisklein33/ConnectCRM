@extends('layouts.app')

@section('content')
<div class="dmd-crea-wrapper">
    <div class="dmd-crea-card">
        <div class="dmd-crea-header">
            <h1 class="dmd-crea-title">Nouvelle Demande Client</h1>
            <p class="dmd-crea-subtitle">Enregistrement d'une nouvelle requête ou d'un projet.</p>
        </div>

        <form action="{{ route('demandes.store') }}" method="POST" class="dmd-crea-form">
            @csrf

            <div class="dmd-crea-group">
                <label class="dmd-crea-label">Client</label>
                <select name="client_id" class="dmd-crea-input @error('client_id') is-invalid @enderror" required>
                    <option value="">Sélectionner un client...</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client_id') <span class="dmd-crea-error">{{ $message }}</span> @enderror
            </div>

            <div class="dmd-crea-group">
                <label class="dmd-crea-label">Email</label>
                <input type="email" name="email" class="dmd-crea-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email') <span class="dmd-crea-error">{{ $message }}</span> @enderror
            </div>

            <div class="dmd-crea-group">
                <label class="dmd-crea-label">Sujet</label>
                <input type="text" name="sujet" class="dmd-crea-input @error('sujet') is-invalid @enderror" value="{{ old('sujet') }}" required>
                @error('sujet') <span class="dmd-crea-error">{{ $message }}</span> @enderror
            </div>

            <div class="dmd-crea-group">
                <label class="dmd-crea-label">Message</label>
                <textarea name="message" class="dmd-crea-input dmd-crea-textarea @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                @error('message') <span class="dmd-crea-error">{{ $message }}</span> @enderror
            </div>

            <input type="hidden" name="statut" value="en attente">

            <div class="dmd-crea-footer">
                <a href="{{ route('demandes.index') }}" class="dmd-crea-btn-back">Annuler</a>
                <button type="submit" class="dmd-crea-btn-submit">Enregistrer la demande client</button>
            </div>
        </form>
    </div>
</div>
@endsection
