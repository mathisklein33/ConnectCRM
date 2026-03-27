@extends('layouts.app')
@section('content')

    <div class="container-fluid quotes-page p-4">
        <div class="d-flex justify-content-between align-items-center page-header">
            <h2 class="page-title">Liste des devis</h2>
            <a href="{{ route('quotes.create') }}" class="btn-primary-custom">
                Créer un devis
            </a>
        </div>
        <div class="card-custom">
            @if($quotes->isEmpty())
                <p class="text-muted">Aucun devis enregistré.</p>
            @else
                <div class="dmd-card d-flex gap-3 justify-content-between">
                    <table class="dmd-table">
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
                                <td class="fw-semibold text-success">
                                    {{ number_format($quote->total, 2, ',', ' ') }} €
                                </td>
                                <td class="p-3">
                                <span class="status-badge">
                                    {{ $quote->status }}
                                </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-3 justify-content-center">
                                        <a href="{{ route('quotes.show', $quote->id) }}"
                                           class="btn-info-custom">
                                            Voir
                                        </a>

                                        <a href="{{ route('quotes.pdf', $quote->id) }}"
                                           class="btn-secondary-custom">
                                            PDF
                                        </a>

                                        <a href="{{ route('quotes.edit', $quote->id) }}"
                                           class="btn-warning-custom">
                                            Modifier
                                        </a>

                                        <form action="{{ route('quotes.destroy', $quote->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce devis ?')">
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
