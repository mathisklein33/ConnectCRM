@extends('layouts.app')
@section('content')

    <div class="container-fluid dashboard">
        <div class="row g-3 mb-4 dashboard-stats">
            <div class="col-md-3">
                <div class="card stat-card stat-green">
                    <h2 class="stat-title">Prospects récents</h2>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between stat-row">
                    <p class="stat-value">12</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" fill="currentColor" class="dashboard-icon bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    </svg>
                </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-blue">
                    <h2 class="stat-title">Prospects ouverts</h2>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between stat-row">
                    <p class="stat-value">5</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" fill="currentColor" class="dashboard-icon bi bi-envelope-open-fill" viewBox="0 0 16 16">
                            <path d="M8.941.435a2 2 0 0 0-1.882 0l-6 3.2A2 2 0 0 0 0 5.4v.314l6.709 3.932L8 8.928l1.291.718L16 5.714V5.4a2 2 0 0 0-1.059-1.765zM16 6.873l-5.693 3.337L16 13.372v-6.5Zm-.059 7.611L8 10.072.059 14.484A2 2 0 0 0 2 16h12a2 2 0 0 0 1.941-1.516M0 13.373l5.693-3.163L0 6.873z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-orange">
                    <h2 class="stat-title">Tâches du jour</h2>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between stat-row">
                    <p class="stat-value">5</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" fill="currentColor" class="dashboard-icon bi bi-card-checklist" viewBox="0 0 16 16">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                    </svg>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-purple m-0">
                    <h2 class="stat-title">Revenus ce mois-ci</h2>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between stat-row">
                        <p class="stat-value">67 €</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" fill="currentColor" class=" dashboard-icon bi bi-bar-chart-fill" viewBox="0 0 16 16">
                            <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="card dashboard-card">
                    <h2 class="card-title">Vente de pipeline</h2>
                    <hr>
                    <div class="pipeline-bar"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card">
                    <h2 class="card-title">Tâches à venir</h2>
                    <hr>
                    <div class="task-item">
                        <input type="checkbox"> Appel avec client A
                    </div>
                    <div class="task-item">
                        <input type="checkbox"> Suivi avec Sarah
                    </div>
                    <div class="task-item">
                        <input type="checkbox"> Préparer des choses
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <h2 class="card-title">Activités récentes</h2>
                    <hr>
                    <div class="activity-item">machine bidule trucmuche</div>
                    <div class="activity-item">machine bidule trucmuche</div>
                    <div class="activity-item">machine bidule trucmuche</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card dashboard-card">
                    <h2 class="card-title">Top offre actuelle</h2>
                    <hr>
                    <table class="table dashboard-table">
                        <tr>
                            <th>Offre</th>
                            <th>Entreprise</th>
                            <th>Montant</th>
                            <th>Statut</th>
                        </tr>
                        <tr>
                            <td>Mise à jour logiciel</td>
                            <td>Renaud</td>
                            <td>1230€</td>
                            <td>Fini</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <h2 class="card-title">Chiffre d'affaires mensuel</h2>
                    <div class="fake-chart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <h2 class="card-title">Pipeline commercial</h2>
                    <div class="fake-chart"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
