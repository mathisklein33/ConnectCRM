@extends('layouts.app')

@section('content')
    <h2>Liste des factures</h2>

    <a href="{{ route('invoices.create') }}">Créer une facture</a>

    <br><br>

    @if($invoices->isEmpty())
        <p>Aucune facture enregistrée.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->number }}</td>
                    <td>{{ $invoice->client->name ?? 'Client supprimé' }}</td>
                    <td>{{ number_format($invoice->total, 2, ',', ' ') }} €</td>
                    <td>{{ $invoice->status }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}">Voir</a> |
                        <a href="{{ route('invoices.edit', $invoice->id) }}">Modifier</a> |
                        <a href="{{ route('invoices.pdf', $invoice->id) }}">Télécharger PDF</a>

                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer cette facture ?')">
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
