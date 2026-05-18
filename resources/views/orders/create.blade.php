@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer une commande</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" class="form-control" required>
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quote_id" class="form-label">Devis associé</label>
            <select name="quote_id" class="form-control">
                <option value="">-- Aucun devis --</option>
                @foreach($quotes as $quote)
                    <option value="{{ $quote->id }}">
                        DEV-{{ $quote->id }} | {{ $quote->total }} €
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Numéro de commande</label>
            <input type="text" name="number" class="form-control"
                   value="CMD-{{ date('Ymd') }}-{{ rand(100,999) }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Total (€)</label>
            <input type="number" step="0.01" name="total" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
