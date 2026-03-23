@extends('layouts.app')

@section('content')
    <div class="asgn-wrapper">
        <div class="asgn-card">
            <div class="asgn-header">
                <h1 class="asgn-title">Assignation de tâche</h1>
                <p class="asgn-subtitle">Demande #{{ $demande->id }} : {{ $demande->sujet }}</p>
            </div>

            <div class="asgn-info-box">
                <strong>Client :</strong> {{ $demande->client->name }} <br>
                <strong>Description :</strong> {{ Str::limit($demande->message, 150) }}
            </div>

            <form action="{{ route('demandes.storeAssignation', $demande->id) }}" method="POST" class="asgn-form">
                @csrf
                @method('PATCH')

                <div class="asgn-group">
                    <label class="asgn-label">Choisir un membre de l'équipe</label>
                    <select name="user_id" class="asgn-input">
                        <option value="">-- Non assigné (Libre) --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $demande->user_id == $user->id ? 'selected' : '' }}>
                                👤 {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="asgn-footer">
                    <a href="{{ route('demandes.index') }}" class="asgn-btn-cancel">Retour</a>
                    <button type="submit" class="asgn-btn-submit">Confirmer l'assignation</button>
                </div>
            </form>
        </div>
    </div>
@endsection
