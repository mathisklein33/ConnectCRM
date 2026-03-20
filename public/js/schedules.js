document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const form = document.getElementById('eventForm');
    const modal = document.getElementById('eventModal');

    // 1. Initialisation du Calendrier
    if (calendarEl) {
        window.calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'fr',
            // Utilise l'URL définie dans ton Blade (plus sûr que de l'écrire en dur)
            events: window.routes.data || '/api/schedules',

            select: function(info) {
                document.getElementById('date').value = info.startStr.split('T')[0];
                openModal();
            },
            eventClick: function(info) {
                alert('Rendez-vous : ' + info.event.title + (info.event.extendedProps.description ? '\n' + info.event.extendedProps.description : ''));
            }
        });
        window.calendar.render();
    }

    // 2. Gestion de l'envoi du formulaire
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
                    // Rafraîchit les événements sans recharger toute la page
                    if (window.calendar) window.calendar.refetchEvents();
                    form.reset();
                })
                .catch(err => {
                    console.error(err);
                    alert("Erreur lors de l'enregistrement.");
                });
        };
    }
});

// 3. Fonctions Globales (doivent être en dehors du DOMContentLoaded)
function openModal() {
    const modal = document.getElementById('eventModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex'); // Pour Tailwind
    }
}

function closeModal() {
    const modal = document.getElementById('eventModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// Fermer au clic sur le fond gris
window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target == modal) {
        closeModal();
    }
}
