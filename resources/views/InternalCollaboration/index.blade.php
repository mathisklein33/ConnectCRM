@extends('layouts.app')
@section('content')
    <div class="ic-wrapper">
        <h1 class="ic-title">Notes internes</h1>

        <div class="ic-form-card">
            <form action="{{ route('InternalCollaboration.store') }}" method="POST">
                @csrf

                @php
                    $currentUser = Auth::user();
                    $team = $currentUser->teams->first();
                @endphp

                <div class="ic-user-info">
                    <span class="ic-label">Auteur :</span>
                    <span class="ic-user-badge">{{ $currentUser->name }}</span>
                </div>

                <input type="hidden" name="team_id" id="team_id_input" value="">

                <label class="ic-label" for="type">Type de message :</label>
                <select name="type" id="type" class="ic-select">
                    <option value="global">Global (Tout le monde)</option>
                    <option value="team">Équipe ({{ $team?->name ?? 'Privé' }})</option>
                </select>

                <input type="hidden" name="user_id" value="{{ $currentUser->id }}">

                <label class="ic-label" for="message">Message :</label>
                <textarea name="message" id="message" class="ic-textarea" placeholder="Écrivez votre note ici..." required></textarea>

                <button type="submit" class="ic-btn-submit">Envoyer la note</button>
            </form>
        </div>

        <h2 class="ic-section-subtitle">Messages globaux</h2>
        <ul class="ic-message-list">
            @foreach($internalCollaborations->whereNull('team_id') as $globalMsg)
                <li class="ic-message-item">
                    <strong class="ic-message-author">{{ $globalMsg->user->name }} :</strong>
                    <span class="ic-message-text">{{ $globalMsg->message }}</span>
                </li>
            @endforeach
        </ul>

        <div class="ic-team-section">
            <h2 class="ic-section-subtitle">Équipe : {{ $team?->name ?? 'Aucune équipe' }}</h2>
            <ul class="ic-message-list">
                @foreach($internalCollaborations->where('team_id', $team?->id) as $msg)
                    <li class="ic-message-item">
                        <strong class="ic-message-author">{{ $msg->user?->name ?? 'Utilisateur inconnu' }} :</strong>
                        <span class="ic-message-text">{{ $msg->message }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        const typeSelect = document.getElementById('type');
        const teamInput = document.getElementById('team_id_input');
        const userTeamId = "{{ $team?->id }}";

        function updateTeamField() {
            teamInput.value = (typeSelect.value === 'team') ? userTeamId : "";
        }

        typeSelect.addEventListener('change', updateTeamField);
        updateTeamField();
    </script>
@endsection
