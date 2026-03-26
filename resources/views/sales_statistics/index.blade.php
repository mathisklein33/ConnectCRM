@extends('layouts.app')

@section('content')
    <h2>Statistiques de ventes</h2>

    <a href="{{ route('sales_statistics.create') }}">Ajouter une statistique</a>

    <br><br>

    @if($salesStatistics->isEmpty())
        <p>Aucune donnée disponible.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Nombre de ventes</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($salesStatistics as $stat)
                <tr>
                    <td>{{ $stat->id }}</td>
                    <td>{{ optional($stat->client)->name ?? 'Client supprimé' }}</td>
                    <td>{{ number_format($stat->amount, 2, ',', ' ') }} €</td>
                    <td>{{ $stat->sales_count }}</td>
                    <td>{{ $stat->date }}</td>
                    <td>
                        <a href="{{ route('sales_statistics.show', $stat->id) }}">Voir</a> |
                        <a href="{{ route('sales_statistics.edit', $stat->id) }}">Modifier</a>

                        <form action="{{ route('sales_statistics.destroy', $stat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ?')">
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
