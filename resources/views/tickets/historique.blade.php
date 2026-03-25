@extends('layouts.app')

@section('content')
    <div class="container-fluid tickets-page">
        <div class="d-flex justify-content-between align-items-center tickets-header">
            <h2 class="page-title">Historique des tickets résolus</h2>
        </div>

        <div class="card-custom">
            <table class="ticket-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Résolu par</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->client->name ?? '-' }}</td>
                        <td>{{ $ticket->name_ticket }}</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->date_ticket)->format('d/m/Y') }}</td>
                        <td>{{ $ticket->user->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-info-custom">
                                Voir
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Aucun ticket résolu.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
