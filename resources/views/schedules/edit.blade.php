@extends('layouts.app')

    @section('content')

        <div class="client-form-container">
            <div class="modal-header">
                <h3>Modifier le rendez-vous</h3>
            </div>

            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST" id="editScheduleForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="schedule-label">Titre de l'événement</label>
                    <input type="text" name="title" class="schedule-input"
                           value="{{ old('title', $schedule->title) }}"
                           placeholder="Réunion, Intervention..." required>
                    @error('title') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="schedule-label">Description (optionnelle)</label>
                    <textarea name="description" class="schedule-input" rows="2"
                              placeholder="Détails supplémentaires...">{{ old('description', $schedule->description) }}</textarea>
                    @error('description') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="schedule-label">Équipe / Type</label>
                    <select name="team_id" id="team_select" class="schedule-input">
                        <option value="">-- Événement GLOBAL (Toute l'entreprise) --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_id', $schedule->team_id) == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="schedule-label">Utilisateur</label>
                    <select name="user_id" id="user_select" class="schedule-input" required>
                        <option value="">Sélectionnez un utilisateur</option>
                        {{-- Les options seront injectées par le script ci-dessous --}}
                    </select>
                    @error('user_id') <div class="error-msg">{{ $message }}</div> @enderror
                </div>

                {{-- Template masqué pour le filtrage JS --}}
                <template id="user_template">
                    @foreach($users as $user)
                        @foreach($user->teams as $team)
                            <option value="{{ $user->id }}" data-team="{{ $team->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    @endforeach
                </template>

                <div class="form-row">
                    <div class="form-group full">
                        <label class="schedule-label">Date</label>
                        <input type="date" name="date" id="date" class="schedule-input"
                               value="{{ old('date', $schedule->date ? $schedule->date->format('Y-m-d') : '') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="schedule-label">Heure Début</label>
                        <input type="time" name="start_time" class="schedule-input"
                               value="{{ old('start_time', $schedule->start_time) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="schedule-label">Heure Fin</label>
                        <input type="time" name="end_time" class="schedule-input"
                               value="{{ old('end_time', $schedule->end_time) }}" required>
                    </div>
                </div>

                <div class="modal-footer" style="margin-top: 20px; display: flex; gap: 10px;">
                    <button type="submit" class="btn-schedule-primary">Enregistrer les modifications</button>
                    <a href="{{ route('schedules.index') }}" class="btn-schedule-secondary" style="text-decoration: none; padding: 10px 15px; background: #eee; border-radius: 4px; color: #333;">Annuler</a>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const teamSelect = document.getElementById('team_select');
                const userSelect = document.getElementById('user_select');
                const template = document.getElementById('user_template');

                // On récupère l'ID utilisateur actuel (soit l'ancienne saisie en cas d'erreur, soit la DB)
                const currentUserId = "{{ old('user_id', $schedule->user_id) }}";

                function filterUsers(teamId) {
                    userSelect.innerHTML = '<option value="">Sélectionnez un utilisateur</option>';

                    const options = template.content.querySelectorAll('option');
                    options.forEach(option => {
                        if (!teamId || option.dataset.team == teamId) {
                            const clone = option.cloneNode(true);
                            if (clone.value == currentUserId) {
                                clone.selected = true;
                            }
                            userSelect.appendChild(clone);
                        }
                    });
                }

                // Écouteur de changement
                teamSelect.addEventListener('change', (e) => filterUsers(e.target.value));

                // Initialisation au chargement
                filterUsers(teamSelect.value);
            });
        </script>
@endsection
