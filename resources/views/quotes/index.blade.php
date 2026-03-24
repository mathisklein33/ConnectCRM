@extends('layouts.app')

@section('content')
    <h2>Liste des devis</h2>

    <a href="{{ route('quotes.create') }}">Créer un devis</a>

    <br><br>

    @if($quotes->isEmpty())
        <p>Aucun devis enregistré.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Titre</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quotes as $quote)
                <tr>
                    <td>{{ $quote->id }}</td>
                    <td>{{ $quote->number }}</td>
                    <td>{{ $quote->client->name ?? 'Client supprimé' }}</td>
                    <td>{{ $quote->title }}</td>
                    <td>{{ number_format($quote->total, 2, ',', ' ') }} €</td>
                    <td>{{ $quote->status }}</td>
                    <td>
                        <a href="{{ route('quotes.show', $quote->id) }}">Voir</a> |
                        <a href="{{ route('quotes.edit', $quote->id) }}">Modifier</a> |
                        <a href="{{ route('quotes.pdf', $quote->id) }}">Télécharger PDF</a>

                        <form action="{{ route('quotes.destroy', $quote->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce devis ?')">
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
