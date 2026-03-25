@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h2>Détail du ticket</h2>
        <div class="card dashboard-card">
            <p><strong>Client :</strong> {{ $ticket->client->name }}</p>
            <p><strong>Titre :</strong> {{ $ticket->name_ticket }}</p>
            <p><strong>Description :</strong></p>
            <p>{{ $ticket->description }}</p>
            <p><strong>Date :</strong> {{ substr($ticket->date_ticket,0,10) }}</p>
            <p><strong>Statut :</strong>
                @if($ticket->valide)
                    Résolu
                @else
                    Ouvert
                @endif
            </p>
        </div>
    </div>

@endsection
