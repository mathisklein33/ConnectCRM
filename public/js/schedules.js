document.addEventListener('DOMContentLoaded', function() {
    // 1. Éléments du DOM
    const calendarEl = document.getElementById('calendar');
    const form = document.getElementById('eventForm');
    const teamSelect = document.getElementById('team_select');
    const userSelect = document.getElementById('user_select');

    // -------------------------------------------------------
    // DÉTECTION DU CONTEXTE : page équipe ou page globale ?
    // -------------------------------------------------------
    const isTeamPage = typeof window.currentTeamId !== 'undefined';
    const teamId     = isTeamPage ? window.currentTeamId : null;

    // -------------------------------------------------------
    // FONCTION : changer la source de données du calendrier
    // (déclarée AVANT l'init du calendrier pour être accessible)
    // -------------------------------------------------------
    function updateCalendarSource(teamIdFilter) {
        if (!window.calendar) return;

        let newUrl = window.routes.data;

        if (teamIdFilter && teamIdFilter !== "") {
            newUrl += "?team_id=" + teamIdFilter;
        }

        console.log("URL chargée :", newUrl);

        window.calendar.removeAllEventSources();
        window.calendar.addEventSource(newUrl);
    }

    // 2. Initialisation du Calendrier FullCalendar
    if (calendarEl) {
        window.calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            contentHeight: 'auto',
            height: 'auto',
            expandRows: true,
            stickyHeaderDates: true,
            handleWindowResize: true,
            locale: 'fr',
            selectable: true,
            slotMinTime: '06:00:00',
            slotMaxTime: '20:00:00',

            // ✅ On ne met plus l'URL ici — updateCalendarSource s'en charge
            events: [],

            select: function(info) {
                document.getElementById('date').value = info.startStr.split('T')[0];

                if (isTeamPage) {
                    if (teamSelect) {
                        teamSelect.value = teamId;
                        teamSelect.dispatchEvent(new Event('change'));
                    }
                } else {
                    const viewType = document.querySelector('.tab-btn.active')?.getAttribute('data-view');

                    if (viewType === 'global') {
                        teamSelect.value = "";
                        teamSelect.dispatchEvent(new Event('change'));
                    } else {
                        const filterTeamSelect = document.getElementById('filter_team_id');
                        teamSelect.value = filterTeamSelect ? filterTeamSelect.value : "";
                        teamSelect.dispatchEvent(new Event('change'));
                    }
                }

                openModal();
            },

            eventClick: function(info) {
                alert('Rendez-vous : ' + info.event.title + (info.event.extendedProps.description ? '\n' + info.event.extendedProps.description : ''));
            }
        });

        window.calendar.render();

        // ✅ Charger la bonne source dès le départ
        if (isTeamPage) {
            updateCalendarSource(teamId);  // → /api/schedules?team_id=X
        } else {
            updateCalendarSource(null);    // → /api/schedules
        }
    }

    // -------------------------------------------------------
    // GESTION DES ONGLETS ET FILTRE (page globale uniquement)
    // -------------------------------------------------------
    const filterTeamSelect = document.getElementById('filter_team_id');
    const tabBtns = document.querySelectorAll('.tab-btn');

    if (!isTeamPage) {
        if (filterTeamSelect) {
            filterTeamSelect.addEventListener('change', function() {
                updateCalendarSource(this.value);
            });
        }

        if (tabBtns) {
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const viewType = this.getAttribute('data-view');
                    const selectorContainer = document.getElementById('team-selector-container');

                    if (viewType === 'global') {
                        selectorContainer?.classList.add('hidden');
                        updateCalendarSource(null);
                    } else {
                        selectorContainer?.classList.remove('hidden');
                        updateCalendarSource(filterTeamSelect ? filterTeamSelect.value : null);
                    }
                });
            });
        }
    }

    // -------------------------------------------------------
    // 3. Filtrage dynamique des utilisateurs par équipe (original)
    // -------------------------------------------------------
    if (teamSelect && userSelect) {
        teamSelect.addEventListener('change', function() {
            const selectedTeamId = this.value;
            const allOptions = document.getElementById('user_template').content.querySelectorAll('option');

            userSelect.innerHTML = '';

            if (selectedTeamId === "") {
                userSelect.disabled = true;
                userSelect.innerHTML = '<option value="">Sélectionnez d\'abord une équipe</option>';
                return;
            }

            const defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.text = "Choisir un membre...";
            userSelect.appendChild(defaultOption);

            let hasUsers = false;
            allOptions.forEach(option => {
                if (option.getAttribute('data-team') === selectedTeamId) {
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

    // -------------------------------------------------------
    // 4. Soumission du formulaire AJAX (original)
    // -------------------------------------------------------
    if (form) {
        form.onsubmit = function(e) {
            e.preventDefault();

            if (userSelect) userSelect.disabled = false;
            const formData = new FormData(this);
            if (userSelect) userSelect.disabled = true;

            fetch(window.routes.store, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    return response.text().then(text => {
                        console.log('Status HTTP :', response.status);
                        console.log('Réponse brute :', text);
                        if (!response.ok) throw new Error(text);
                        return JSON.parse(text);
                    });
                })
                .then(data => {
                    alert("Rendez-vous enregistré !");
                    closeModal();
                    if (window.calendar) window.calendar.refetchEvents();
                    form.reset();
                    if (userSelect) userSelect.disabled = true;
                })
                .catch(err => {
                    console.error('Détail erreur :', err.message);
                    alert("Erreur : " + err.message);
                });
        };
    }
});

// -------------------------------------------------------
// Fonctions globales (original)
// -------------------------------------------------------
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

window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target == modal) {
        closeModal();
    }
}
