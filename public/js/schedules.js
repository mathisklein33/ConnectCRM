document.addEventListener('DOMContentLoaded', function() {
    // 1. Éléments du DOM
    const calendarEl = document.getElementById('calendar');
    const form = document.getElementById('eventForm');
    const teamSelect = document.getElementById('team_select');
    const userSelect = document.getElementById('user_select');
    const userOptions = document.querySelectorAll('.user-option');

    // 2. Initialisation du Calendrier FullCalendar
    if (calendarEl) {
        window.calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'fr',
            selectable: true,
            events: window.routes.data || '/api/schedules',

            select: function(info) {
                // Remplit la date automatiquement au clic
                document.getElementById('date').value = info.startStr.split('T')[0];
                openModal();
            },
            eventClick: function(info) {
                alert('Rendez-vous : ' + info.event.title + (info.event.extendedProps.description ? '\n' + info.event.extendedProps.description : ''));
            }
        });
        window.calendar.render();
    }

    // 3. Filtrage Dynamique des Utilisateurs par Équipe
    // 3. Filtrage Dynamique des Utilisateurs par Équipe
    if (teamSelect && userSelect) {
        teamSelect.addEventListener('change', function() {
            const selectedTeamId = this.value;
            const allOptions = document.getElementById('user_template').content.querySelectorAll('option');

            // Nettoyer le sélecteur d'utilisateur
            userSelect.innerHTML = '';

            if (selectedTeamId === "") {
                userSelect.disabled = true;
                userSelect.innerHTML = '<option value="">Sélectionnez d\'abord une équipe</option>';
                return;
            }

            // Ajouter l'option par défaut
            const defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.text = "Choisir un membre...";
            userSelect.appendChild(defaultOption);

            // Filtrer et ajouter les utilisateurs correspondants
            let hasUsers = false;
            allOptions.forEach(option => {
                if (option.getAttribute('data-team') === selectedTeamId) {
                    // On clone l'option pour l'ajouter au vrai select
                    userSelect.appendChild(option.cloneNode(true));
                    hasUsers = true;
                }
            });

            if (hasUsers) {
                userSelect.disabled = false;
            } else {
                userSelect.disabled = true;
                defaultOption.text = "Aucun utilisateur dans cette équipe";
            }
        });
    }

    // 4. Gestion de l'envoi du formulaire (AJAX)
    if (form) {
        form.onsubmit = function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(window.routes.store, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Erreur serveur');
                    return response.json();
                })
                .then(data => {
                    alert("Rendez-vous enregistré !");
                    closeModal();
                    if (window.calendar) window.calendar.refetchEvents();
                    form.reset();
                    // On redésactive le select utilisateur après reset
                    userSelect.disabled = true;
                })
                .catch(err => {
                    console.error(err);
                    alert("Erreur lors de l'enregistrement.");
                });
        };
    }
});

// --- Fonctions Globales ---

function openModal() {
    const modal = document.getElementById('eventModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// Fermer au clic sur l'arrière-plan (overlay)
window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target == modal) {
        closeModal();
    }
}
