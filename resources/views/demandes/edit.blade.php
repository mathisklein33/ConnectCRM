@extends('layouts.app')

@section('content')
    <div class="dmd-edit-wrapper">
        <div class="dmd-edit-card">
            <div class="dmd-edit-header">
                <h1 class="dmd-edit-title">Modifier la Demande #{{ $demande->id }}</h1>
                <p class="dmd-edit-subtitle">Mise à jour des informations et de l'assignation.</p>
            </div>

            <form action="{{ route('demandes.update', $demande->id) }}" method="POST" class="dmd-edit-form">
                @csrf
                @method('PUT')

                <div class="dmd-edit-row">
                    <div class="dmd-edit-group dmd-edit-flex-2">
                        <label class="dmd-edit-label">Client</label>
                        <select name="client_id" class="dmd-edit-input @error('client_id') is-invalid @enderror" required>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ (old('client_id', $demande->client_id) == $client->id) ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dmd-edit-group dmd-edit-flex-1">
                        <label class="dmd-edit-label">Statut actuel</label>
                        <select name="statut" class="dmd-edit-input" required>
                            <option value="en attente" {{ $demande->statut == ' en attente ' ? 'selected' : '' }}>En attente</option>
                            <option value="traitée" {{ $demande->statut == 'traitée' ? 'selected' : '' }}>Traitée</option>
                            <option value="refusée" {{ $demande->statut == 'refusée' ? 'selected' : '' }}>Refusée</option>
                        </select>
                    </div>
                </div>

                <div class="dmd-edit-row">
                    <div class="dmd-edit-group dmd-edit-flex-1">
                        <label class="dmd-edit-label">Email de contact</label>
                        <input type="email" name="email" class="dmd-edit-input" value="{{ old('email', $demande->email) }}" required>
                    </div>

                    <div class="dmd-edit-group dmd-edit-flex-1">
                        <label class="dmd-edit-label">Assigner à</label>
                        <select name="user_id" class="dmd-edit-input">
                            <option value="">-- Non assigné --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ (old('user_id', $demande->user_id) == $user->id) ? 'selected' : '' }}>
                                    👤 {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="dmd-edit-group">
                    <label class="dmd-edit-label">Sujet</label>
                    <input type="text" name="sujet" class="dmd-edit-input" value="{{ old('sujet', $demande->sujet) }}" required>
                </div>

                <div class="dmd-edit-group">
                    <label class="dmd-edit-label">Message / Description</label>
                    <textarea name="message" class="dmd-edit-input dmd-edit-textarea" rows="6" required>{{ old('message', $demande->message) }}</textarea>
                </div>

                <div class="dmd-edit-footer">
                    <a href="{{ route('demandes.show', $demande->id) }}" class="dmd-edit-btn-cancel">Annuler</a>
                    <button type="submit" class="dmd-edit-btn-submit">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
@endsection
