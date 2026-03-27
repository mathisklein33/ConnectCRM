@extends('layouts.app')

@section('content')
    <div class="dmd-crea-wrapper">
        <div class="dmd-crea-card">
            <div class="dmd-crea-header">
                <h1 class="dmd-crea-title">Notes internes</h1>
                <p class="dmd-crea-subtitle">Partagez des informations avec votre équipe ou l'ensemble de l'organisation.</p>
            </div>

            <div class="dmd-crea-form">
                <form action="{{ route('internal-collaboration.store') }}" method="POST">
                    @csrf

                    @php
                        $currentUser = Auth::user();
                        $team = $currentUser->teams->first();
                    @endphp

                    <div class="asgn-info-box">
                        <span class="dmd-crea-label">Auteur :</span>
                        <strong style="color: var(--dmd-slate-800)">{{ $currentUser->name }}</strong>
                    </div>

                    <input type="hidden" name="team_id" id="team_id_input" value="">

                    <div class="dmd-crea-group" style="margin-bottom: 1.5rem;">
                        <label class="dmd-crea-label" for="type">Type de message</label>
                        <select name="type" id="type" class="dmd-crea-input">
                            <option value="global">🌍 Global (Tout le monde)</option>
                            <option value="team">👥 Équipe ({{ $team?->name ?? 'Privé' }})</option>
                        </select>
                    </div>

                    <input type="hidden" name="user_id" value="{{ $currentUser->id }}">

                    <div class="dmd-crea-group" style="margin-bottom: 1.5rem;">
                        <label class="dmd-crea-label" for="message">Message</label>
                        <textarea name="message" id="message" class="dmd-crea-input dmd-crea-textarea" placeholder="Écrivez votre note ici..." required></textarea>
                    </div>

                    <div class="dmd-crea-footer">
                        <button type="submit" class="dmd-crea-btn-submit">Envoyer la note</button>
                    </div>
                </form>
            </div>
        </div>

        <div style="max-width: 850px; margin: 2rem auto;">
            <h2 class="dmd-view-section-title">Messages globaux</h2>
            <div class="dmd-card" style="padding: 1rem; margin-bottom: 2rem;">
                <ul style="list-style: none; padding: 0;">
                    @foreach($internalCollaborations->whereNull('team_id') as $globalMsg)
                        <li style="padding: 1rem; border-bottom: 1px solid var(--dmd-border);">
                            <strong class="dmd-client-name">{{ $globalMsg->user->name }} :</strong>
                            <p class="dmd-excerpt">{{ $globalMsg->message }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <h2 class="dmd-view-section-title">Équipe : {{ $team?->name ?? 'Aucune équipe' }}</h2>
            <div class="dmd-card" style="padding: 1rem;">
                <ul style="list-style: none; padding: 0;">
                    @foreach($internalCollaborations->where('team_id', $team?->id) as $msg)
                        <li style="padding: 1rem; border-bottom: 1px solid var(--dmd-border);">
                            <strong class="dmd-client-name">{{ $msg->user?->name ?? 'Utilisateur inconnu' }} :</strong>
                            <p class="dmd-excerpt">{{ $msg->message }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
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
