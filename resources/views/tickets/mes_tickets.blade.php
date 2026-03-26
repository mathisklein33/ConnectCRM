@extends('layouts.app')

@section('content')
    <div class="container-fluid tickets-page">
        <div class="d-flex justify-content-between align-items-center tickets-header">
            <h2 class="page-title">Mes tickets en cours</h2>
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
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->client->name ?? '-' }}</td>
                        <td>{{ $ticket->name_ticket }}</td>
                        <td>{{ \Carbon\Carbon::parse($ticket->date_ticket)->format('d/m/Y') }}</td>
                        <td>
                            <span class="status status-progress">En cours</span>
                        </td>
                        <td>{{ $ticket->user->name ?? '-' }}</td>
                        <td class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-info-custom">
                                Voir
                            </a>

                            <form action="{{ route('tickets.resolve', $ticket->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-success-custom">
                                    Résoudre
                                </button>
                            </form>

                            <button type="button" class="btn-warning-custom" onclick="document.getElementById('transfer-form-{{ $ticket->id }}').classList.toggle('d-none')">
                                Transférer
                            </button>

                            <form id="transfer-form-{{ $ticket->id }}" action="{{ route('tickets.transfer', $ticket->id) }}" method="POST" class="d-none mt-2">
                                @csrf
                                <select name="user_id" class="form-control" required>
                                    <option value="">Choisir un utilisateur</option>
                                    @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn-primary-custom mt-2">
                                    Confirmer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Aucun ticket en cours ne vous est assigné.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
