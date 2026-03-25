@extends('layouts.app')
@section('content')

    <div class="container-fluid tickets-page">
        <div class="d-flex justify-content-between align-items-center tickets-header">
            <h2 class="page-title">Tickets support</h2>
            <a href="{{ route('tickets.create') }}" class="btn-primary-custom">
                Nouveau ticket
            </a>
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->client->name ?? '-' }}</td>
                        <td>{{ $ticket->name_ticket }}</td>
                        <td>{{ substr($ticket->date_ticket,0,10) }}</td>
                        <td>
                            @if($ticket->valide)
                                <span class="status status-valid">Résolu</span>
                            @else
                                <span class="status status-open">Ouvert</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('tickets.show',$ticket->id) }}" class="btn-info-custom">Voir</a>
                            <a href="{{ route('tickets.edit',$ticket->id) }}" class="btn-warning-custom">Modifier</a>
                            <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">
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
