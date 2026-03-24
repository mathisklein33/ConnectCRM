@extends('layouts.app')

@section('content')
    <h1>Détail de la facture</h1>

    <p><strong>ID :</strong> {{ $invoice->id }}</p>
    <p><strong>Numéro :</strong> {{ $invoice->number ?? 'Non défini' }}</p>
    <p><strong>Client :</strong> {{ optional($invoice->client)->name ?? 'Client supprimé' }}</p>
    <p><strong>Total :</strong> {{ number_format((float) ($invoice->total ?? 0), 2, ',', ' ') }} €</p>
    <p><strong>Statut :</strong> {{ $invoice->status ?? 'Non défini' }}</p>

    <a href="{{ route('invoices.index') }}">Retour à la liste</a>
@endsection
