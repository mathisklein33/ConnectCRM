@extends('layouts.app')

@section('content')
    <div class="dmd-wrapper">
        <div class="dmd-header">
            <div>
                <h1 class="dmd-page-title">Suivi des Demandes</h1>
                <p class="dmd-subtitle">Gestion et historique des requêtes clients</p>
            </div>
            <a href="/demandes/create" class="dmd-btn-create">+ Nouvelle Demande</a>
        </div>

        @if(session('success'))
            <div class="dmd-alert dmd-alert-success">{{ session('success') }}</div>
        @endif
        <div class="dmd-filter-bar">
            <form action="{{ route('demandes.index') }}" method="GET" class="dmd-filter-form">

                {{-- Afficher le choix du membre SEULEMENT si l'utilisateur est chef --}}
                @if(auth()->user()->hasRole('admin'))
                    <div class="dmd-filter-group">
                        <label>Chef d'équipe :</label>
                        <select name="user_id" onchange="this.form.submit()">
                            <option value="">Tous les membres</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    {{-- Optionnel : Afficher un simple texte pour l'employé --}}
                    <div class="dmd-filter-group">
                        <span class="dmd-badge">Mes dossiers uniquement</span>
                    </div>
                @endif

                <div class="dmd-filter-group">
                    <label>Étape du cycle :</label>
                    <select name="statut" onchange="this.form.submit()">
                        <option value="">Toutes les étapes</option>
                        <option value="en attente" {{ request('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="traitée" {{ request('statut') == 'traitée' ? 'selected' : '' }}>Traitée</option>
                        <option value="refusée" {{ request('statut') == 'refusée' ? 'selected' : '' }}>Refusée</option>
                    </select>
                </div>
            </form>
        </div>

                @if(request()->anyFilled(['user_id', 'statut']))
                    <a href="{{ route('demandes.index') }}" class="dmd-reset-link">Réinitialiser</a>
                @endif
        <div class="dmd-card">
            <div class="dmd-table-responsive">
                <table class="dmd-table">
                    <thead>
                    <tr>
                        <th>Réf.</th>
                        <th>Client</th>
                        <th>Sujet & Message</th>
                        <th>Statut</th>
                        <th>Date d'envoi</th>
                        <th>Assigné à</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($demandes as $demande)
                        <tr>
                            <td class="dmd-id">#{{ $demande->id }}</td>
                            <td>
                                <div class="dmd-client-info">
                                    <span class="dmd-client-name">{{ $demande->client->name }}</span>
                                    <span class="dmd-client-email">{{ $demande->email }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="dmd-message-cell">
                                    <span class="dmd-subject">{{ $demande->sujet }}</span>
                                    <p class="dmd-excerpt">{{ Str::limit($demande->message, 45) }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="dmd-status-wrapper">
                                     <span class="dmd-badge dmd-badge-{{ Str::slug($demande->statut) }}">
                                            {{ ucfirst($demande->statut) }}
                                     </span>
                                    <div class="dmd-progress-track">
                                        <div class="dmd-progress-bar progress-{{ Str::slug($demande->statut) }}"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="dmd-date">{{ $demande->created_at->format('d/m/Y') }} <small>{{ $demande->created_at->format('H:i') }}</small></td>
                            <td>
                                @if($demande->User)
                                    <span class="dmd-user-badge">
                                         👤 {{ $demande->User->name }}
                                     </span>
                                @else
                                    <span style="color: #94a3b8; font-style: italic; font-size: 0.8rem;">Non assigné</span>
                                @endif
                            </td>
                            <td class="dmd-actions">
                                <a href="/demandes/show/{{$demande->id}}" class="dmd-btn-icon dmd-btn-edit">Voir</a>
                                <a href="/demandes/assignation/{{$demande->id}}" class="dmd-btn-icon dmd-btn-edit">Modifier/assigner</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="dmd-empty">Aucune demande trouvée dans la base de données.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
