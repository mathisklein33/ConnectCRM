@extends('layouts.app')

@section('content')
    <div class="schedule-page">
        <div class="page-header">
            <div>
                <h1>Mon Calendrier</h1>
                <p class="subtitle">Gérez vos rendez-vous et votre emploi du temps</p>
            </div>
        </div>

        <div class="calendar-tabs">
            <button class="tab-btn active" data-view="global" hidden="">Vue Globale</button>
            <button class="tab-btn" data-view="team" hidden>Vue par Équipe</button>
        </div>
        <div class="calendar-card">
            <div id='calendar'></div>
        </div>

        <div id="eventModal" class="modal-overlay hidden">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Nouveau rendez-vous</h3>
                </div>

                <form id="eventForm">
                    @csrf
                    <div class="form-group">
                        <label class="schedule-label">Titre de l'événement</label>
                        <input type="text" name="title" class="schedule-input" placeholder="Réunion, Intervention..." required>
                    </div>

                    <div class="form-group">
                        <label class="schedule-label">Description (optionnelle)</label>
                        <textarea name="description" class="schedule-input" rows="2" placeholder="Détails supplémentaires..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="schedule-label">Équipe / Type</label>
                        <select name="team_id" id="team_select" class="schedule-input">
                                <option value="{{ $team->id }}" {{ request()->route('id') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="schedule-label">Utilisateur</label>
                        <select name="user_id" id="user_select" class="schedule-input" required disabled>
                            <option value="">Sélectionnez d'abord une équipe</option>
                        </select>
                    </div>

                    <template id="user_template">
                        @foreach($users as $user)
                            @foreach($user->teams as $userTeam)  {{-- ✅ $userTeam --}}
                            <option value="{{ $user->id }}" data-team="{{ $userTeam->id }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                        @endforeach
                    </template>
                    <div class="form-row">
                        <div class="form-group full">
                            <label class="schedule-label">Date</label>
                            <input type="date" name="date" id="date" class="schedule-input" required>
                        </div>
                        <div class="form-group">
                            <label class="schedule-label">Heure Début</label>
                            <input type="time" name="start_time" class="schedule-input" required>
                        </div>
                        <div class="form-group">
                            <label class="schedule-label">Heure Fin</label>
                            <input type="time" name="end_time" class="schedule-input" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-schedule-primary">Enregistrer le rendez-vous</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    {{-- Remplacer le bloc script existant --}}
    <script>
        window.routes = {
            data:  "{{ url('/api/schedules') }}",
            store: "{{ url('/schedules/store') }}"
        };
        window.csrfToken     = "{{ csrf_token() }}";
        window.currentTeamId = {{ $team->id }};  {{-- ✅ $team est maintenant protégé --}}
    </script>
    <script src="{{ asset('js/schedules.js') }}"></script>
@endsection
