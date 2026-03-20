<div id="eventModal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-slate-800">Ajouter un rendez-vous</h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="eventForm" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Titre</label>
                <input type="text" name="title" id="title" class="input-field" placeholder="Nom de la réunion..." required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="2" class="input-field" placeholder="Détails optionnels..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Date</label>
                    <input type="date" name="date" id="date" class="input-field" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Début</label>
                    <input type="time" name="start_time" id="start_time" class="input-field" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Fin</label>
                    <input type="time" name="end_time" id="end_time" class="input-field" required>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-100">
                <a class="btn-secondary">
                    Retour en arrière
                </a>
                <button type="submit" class="btn-primary">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
