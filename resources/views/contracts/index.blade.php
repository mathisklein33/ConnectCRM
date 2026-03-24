@extends('layouts.app')

@section('content')
    <h2>Liste des contrats</h2>

    <p>
        <a href="{{ route('contracts.create') }}">Créer un contrat</a>
    </p>

    @if(session('success'))
        <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #28a745;">
            {{ session('success') }}
        </div>
    @endif

    @if($contracts->isEmpty())
        <p>Aucun contrat enregistré.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Titre</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Actions</th>
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
                    <td>
                        <a href="{{ route('contracts.show', $contract->id) }}">Voir</a>
                        |
                        <a href="{{ route('contracts.edit', $contract->id) }}">Modifier</a>
                        |
                        <a href="{{ route('contracts.pdf', $contract->id) }}">Télécharger PDF</a>
                        |
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce contrat ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
