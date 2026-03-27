@extends('layouts.app')

@section('content')
    <div class="container-fluid tickets-page p-4">
        <div class="d-flex justify-content-between align-items-center tickets-header">
            <h2 class="page-title">Tickets support</h2>
            <a href="{{ route('tickets.create') }}" class="btn-primary-custom">
                Nouveau ticket
            </a>
            <a href="{{ route('tickets.mine') }}">Mes tickets en cours</a>
            <a href="{{ route('tickets.historique') }}">Historique</a>
        </div>

        <div class="card-custom">
            <table class="ticket-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Assigné à</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->client->name ?? '-' }}</td>
                        <td>{{ $ticket->name_ticket }}</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->date_ticket)->format('d/m/Y') }}</td>
                        <td>
                            @if($ticket->statut === 'ouvert')
                                <span class="status status-open">Ouvert</span>
                            @elseif($ticket->statut === 'en_cours')
                                <span class="status status-progress">En cours</span>
                            @elseif($ticket->statut === 'ferme')
                                <span class="status status-valid">Fermé</span>
                            @endif
                        </td>
                        <td>
                            {{ $ticket->user->name ?? '-' }}
                        </td>
                        <td class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-info-custom">
                                Voir
                            </a>

                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn-warning-custom">
                                Modifier
                            </a>

                            @if($ticket->statut === 'ouvert')
                                <form action="{{ route('tickets.take', $ticket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-success-custom">
                                        Prendre le ticket
                                    </button>
                                </form>
                            @endif
                                <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer ce ticket ?')">
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
