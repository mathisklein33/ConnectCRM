@extends('layouts.app')
@section('content')

    <div class="container-fluid invoices-page p-4">
        <div class="d-flex justify-content-between align-items-center page-header">
            <h2 class="page-title">Liste des factures</h2>
            <a href="{{ route('invoices.create') }}" class="btn-primary-custom">
                Créer une facture
            </a>
        </div>
        <div class="card-custom">
            @if($invoices->isEmpty())
                <p class="text-muted">Aucune facture enregistrée.</p>
            @else
                <div class="card-custom">
                    <table class="ticket-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Numéro</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
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
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('invoices.show', $invoice->id) }}"
                                           class="btn-info-custom">
                                            Voir
                                        </a>
                                        <a href="{{ route('invoices.edit', $invoice->id) }}"
                                           class="btn-warning-custom">
                                            Modifier
                                        </a>
                                        <a href="{{ route('invoices.pdf', $invoice->id) }}"
                                           class="btn-secondary-custom">
                                            PDF
                                        </a>
                                        <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer cette facture ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-danger-custom">
                                                Supprimer
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
