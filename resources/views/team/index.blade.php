@extends('layouts.app')

@section('content')
    <div class="dmd-wrapper">
        <div class="dmd-header">
            <div>
                <h2 class="dmd-page-title">Gestion des équipes</h2>
                <p class="dmd-subtitle">Administrez vos équipes et leurs responsables</p>
            </div>
            <a href="{{ route('team.create') }}" class="dmd-btn-create">
                + Nouvelle équipe
            </a>
        </div>

        <div class="dmd-card">
            <table class="dmd-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom équipe</th>
                    <th>Chef d'équipe</th>
                    <th>Planning</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td class="dmd-id">#{{ $team->id }}</td>
                        <td>
                            <span class="dmd-client-name">{{ $team->name }}</span>
                        </td>
                        <td>
                            @if($team->leader)
                                <span class="dmd-subject">{{ $team->leader }}</span>
                            @else
                                <span >Non assigné</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('team.show', $team->id) }}" class="btn-primary-custom">
                                Voir Planning
                            </a>
                        </td>
                        <td class="dmd-actions">
                            <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                <a href="{{ route('team.edit', $team->id) }}" class="btn-warning-custom" title="Modifier">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>

                                <form action="{{ route('team.destroy', $team->id) }}" method="POST"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cette équipe ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger-custom" title="Supprimer">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if($teams->isEmpty())
                    <tr>
                        <td colspan="5" class="dmd-empty">
                            Aucune équipe n'a été créée pour le moment.
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
