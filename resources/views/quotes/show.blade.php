@extends('layouts.app')

@section('content')
    <h1>Détail du devis</h1>

    <p><strong>ID :</strong> {{ $quote->id }}</p>
    <p><strong>Numéro :</strong> {{ $quote->number ?? 'Non défini' }}</p>
    <p><strong>Client :</strong> {{ optional($quote->client)->name ?? 'Client supprimé' }}</p>
    <p><strong>Total :</strong> {{ number_format((float) ($quote->total ?? 0), 2, ',', ' ') }} €</p>
    <p><strong>Statut :</strong> {{ $quote->status ?? 'Non défini' }}</p>

    <a href="{{ route('quotes.index') }}">Retour à la liste</a>
@endsection
