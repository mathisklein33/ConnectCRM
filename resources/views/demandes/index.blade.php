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
                                {{-- Génération dynamique de badge selon le statut --}}
                                <span class="dmd-badge dmd-badge-{{ Str::slug($demande->statut) }}">
                                {{ $demande->statut }}
                            </span>
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
