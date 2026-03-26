@extends('layouts.app')
@section('content')

    <div class="container-fluid teams-page p-4">
        <div class="d-flex justify-content-between align-items-center page-header">
            <h2 class="page-title">Gestion des équipes</h2>
            <a href="{{ route('team.create') }}" class="btn-primary-custom">
                Nouvelle équipe
            </a>
        </div>
        <div class="card-custom">
            <table class="team-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom équipe</th>
                    <th>Chef d'équipe</th>
                    <th>Planning</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->leader ?? 'Non assigné' }}</td>
                        <td>
                            <a href="{{ route('team.show',$team->id) }}" class="btn-info-custom">
                                Voir planning
                            </a>
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('team.edit',$team->id) }}" class="btn-warning-custom">Modifier</a>

                            <form action="{{ route('team.destroy',$team->id) }}" method="POST"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette équipe ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger-custom">Supprimer</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
