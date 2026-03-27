<div class="d-flex flex-column sidebar p-3">

    <a href="{{ route('clients.create') }}" class="btn-create mb-4">
        + CRÉER UN CLIENT
    </a>

    <ul class="nav flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door me-2" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                </svg>
                Tableau de bord
            </a>
        </li>

        <li class="section-title mt-3">Vente et pipeline</li>

        <li>
            <a href="{{ route('quotes.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text me-2" viewBox="0 0 16 16">
                    <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5A.5.5 0 0 1 5.5 9h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2A.5.5 0 0 1 5.5 11h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                </svg>
                Devis
            </a>
        </li>

        <li>
            <a href="{{ route('contracts.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-check me-2" viewBox="0 0 16 16">
                    <path d="M9.293 9.5 8 10.793 6.707 9.5l-.707.707L8 12.207l2.707-2.707z"/>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                </svg>
                Contrats
            </a>
        </li>

        <li>
            <a href="{{ route('invoices.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt me-2" viewBox="0 0 16 16">
                    <path d="M1.92.506a.5.5 0 0 1 .58.093L3 1.293 3.5.599a.5.5 0 0 1 .8 0l.5.694.5-.694a.5.5 0 0 1 .8 0l.5.694.5-.694a.5.5 0 0 1 .8 0l.5.694.5-.694a.5.5 0 0 1 .8 0l.5.694.5-.694A.5.5 0 0 1 13 1v13a.5.5 0 0 1-.78.416L11.5 13.9l-.72.516a.5.5 0 0 1-.56 0l-.72-.516-.72.516a.5.5 0 0 1-.56 0l-.72-.516-.72.516a.5.5 0 0 1-.56 0l-.72-.516-.72.516A.5.5 0 0 1 1 14V1a.5.5 0 0 1 .92-.494M3 4.5A.5.5 0 0 0 3.5 5h6a.5.5 0 0 0 0-1h-6zm0 2A.5.5 0 0 0 3.5 7h6a.5.5 0 0 0 0-1h-6zm0 2A.5.5 0 0 0 3.5 9h3a.5.5 0 0 0 0-1h-3z"/>
                </svg>
                Factures
            </a>
        </li>

        <li>
            <a href="{{ route('sales_statistics.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-fill me-2" viewBox="0 0 16 16">
                    <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>
                </svg>
                Activité
            </a>
        </li>

        <li class="section-title mt-3">Répertoire des clients</li>

        <li>
            <a href="{{ route('clients.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
                Clients
            </a>
        </li>

        <li>
            <a href="{{ route('interactions.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people me-2" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                </svg>
                Contacts
            </a>
        </li>

        <li>
            <a href="{{ route('demandes.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-paper me-2" viewBox="0 0 16 16">
                    <path d="M6.5 3.5V2h3v1.5h-3z"/>
                    <path d="M3 5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1H3z"/>
                    <path d="M3 7h10v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                Demandes
            </a>
        </li>

        <li class="section-title mt-3">Catalogue et services</li>

        <li>
            <a href="{{ route('products.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam me-2" viewBox="0 0 16 16">
                    <path d="M8.186.113a.5.5 0 0 0-.372 0L1.846 2.5 8 4.833 14.154 2.5zM15 3.077 8.5 5.54v9.348l6-2.286a.5.5 0 0 0 .5-.467zM7.5 14.888V5.54L1 3.077v9.058a.5.5 0 0 0 .5.467z"/>
                </svg>
                Produits
            </a>
        </li>

        <li class="section-title mt-3">Organisation</li>

        <li>
            <a href="{{ route('schedules.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event me-2" viewBox="0 0 16 16">
                    <path d="M11 6.5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0V9h-1a.5.5 0 0 1 0-1h1V7a.5.5 0 0 1 .5-.5"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v1H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 1 0V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 5v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z"/>
                </svg>
                Horaires
            </a>
        </li>

        <li>
            <a href="{{ route('team.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace me-2" viewBox="0 0 16 16">
                    <path d="M6 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M3 3a2 2 0 0 0-2 2v6.5a.5.5 0 0 0 1 0V9h2v2.5a.5.5 0 0 0 1 0V5a1 1 0 0 1 1-1h4a2 2 0 0 1 2 2v1h1V6a3 3 0 0 0-3-3z"/>
                    <path d="M11 12.5a.5.5 0 0 1 .5-.5h1V8.707l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0l1.5 1.5a.5.5 0 0 1-.708.708L14 8.707V12h1a.5.5 0 0 1 0 1h-3.5a.5.5 0 0 1-.5-.5"/>
                </svg>
                Équipe
            </a>
        </li>

        <li>
            <a href="{{ route('internal-collaboration.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text me-2" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4.414L1 15.414V2a1 1 0 0 1 1-1zM2 2v11.586L4.586 11H14V2z"/>
                    <path d="M3 4.5A.5.5 0 0 1 3.5 4h8a.5.5 0 0 1 0 1h-8A.5.5 0 0 1 3 4.5m0 2A.5.5 0 0 1 3.5 6h6a.5.5 0 0 1 0 1h-6A.5.5 0 0 1 3 6.5m0 2A.5.5 0 0 1 3.5 8h5a.5.5 0 0 1 0 1h-5A.5.5 0 0 1 3 8.5"/>
                </svg>
                Collaboration interne
            </a>
        </li>

        <li class="section-title mt-3">Communication</li>

        <li>
            <a href="{{ route('tickets.index') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell me-2" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                </svg>
                Notifications
            </a>
        </li>

        <li class="section-title mt-3">Administration</li>

        <li>
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear me-2" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                </svg>
                Paramètres
            </a>
        </li>

    </ul>

    <a href="{{ route('profile.edit') }}" class="nav-link mt-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
        {{ Auth::user()->name ?? 'Utilisateur' }}
    </a>

    <a href="{{ route('logout.get') }}" class="nav-link logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
        </svg>
        Déconnexion
    </a>

</div>
