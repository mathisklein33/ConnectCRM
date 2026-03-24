@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détail du contrat</h1>

        <p><strong>ID :</strong> {{ $contract->id }}</p>
        <p><strong>Client :</strong> {{ $contract->client->name ?? 'Aucun client' }}</p>
        <p><strong>Titre :</strong> {{ $contract->title ?? 'Sans titre' }}</p>
        <p><strong>Montant :</strong> {{ $contract->amount ?? 'Non défini' }}</p>
    </div>
@endsection
