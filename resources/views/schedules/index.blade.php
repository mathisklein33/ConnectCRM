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

        <div id="team-selector-container" class="hidden">
            <select id="filter_team_id"> <option value="">Toutes les équipes</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
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
                            <option value="">-- Événement GLOBAL (Toute l'entreprise) --</option>

                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
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
                            @foreach($user->teams as $team) {{-- On boucle sur les équipes de l'utilisateur --}}
                            <option value="{{ $user->id }}" data-team="{{ $team->id }}">
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
    <script>
        window.routes = {
            data: "{{ url('/api/schedules') }}",
            store: "{{ url('/schedules/store') }}"
        };
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/schedules.js') }}"></script>
@endsection
