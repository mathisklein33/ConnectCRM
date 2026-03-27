@extends('layouts.app')
@section('content')

    <div class="container-fluid contracts-page p-4">
        <div class="d-flex justify-content-between align-items-center page-header">
            <h2 class="page-title">Liste des contrats</h2>
            <a href="{{ route('contracts.create') }}" class="btn-primary-custom">
                Créer un contrat
            </a>
        </div>
        @if(session('success'))
            <div class="alert-custom-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-custom">
            @if($contracts->isEmpty())
                <p class="text-muted">Aucun contrat enregistré.</p>
            @else
                <div class="dmd-card">
                    <table class="dmd-table">
                        <thead>
                        <tr>
                            <th class=>ID</th>
                            <th>Numéro</th>
                            <th>Client</th>
                            <th>Titre</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $contract)
                            <tr>
                                <td>{{ $contract->id }}</td>
                                <td>{{ $contract->number }}</td>
                                <td>{{ $contract->client->name ?? 'Client supprimé' }}</td>
                                <td>{{ $contract->title }}</td>
                                <td>{{ $contract->start_date ?? '-' }}</td>
                                <td>{{ $contract->end_date ?? '-' }}</td>
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('contracts.show', $contract->id) }}"
                                           class="btn-info-custom">
                                            Voir
                                        </a>
                                        <a href="{{ route('contracts.pdf', $contract->id) }}"
                                           class="btn-secondary-custom">
                                            PDF
                                        </a>
                                        <a href="{{ route('contracts.edit', $contract->id) }}"
                                           class="btn-warning-custom">
                                            Modifier
                                        </a>
                                        <form action="{{ route('contracts.destroy', $contract->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce contrat ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-danger-custom">
                                                Suppr
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
