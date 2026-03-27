@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Modifier la commande</h1>

        {{-- Erreurs --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Client --}}
            <div class="mb-3">
                <label class="form-label">Client</label>
                <select name="client_id" class="form-control" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}"
                            {{ $order->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Devis --}}
            <div class="mb-3">
                <label class="form-label">Devis associé</label>
                <select name="quote_id" class="form-control">
                    <option value="">-- Aucun devis --</option>
                    @foreach($quotes as $quote)
                        <option value="{{ $quote->id }}"
                            {{ $order->quote_id == $quote->id ? 'selected' : '' }}>
                            DEV-{{ $quote->id }} | {{ $quote->total }} €
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Numéro --}}
            <div class="mb-3">
                <label class="form-label">Numéro</label>
                <input type="text" name="number" class="form-control"
                       value="{{ old('number', $order->number) }}" required>
            </div>

            {{-- Total --}}
            <div class="mb-3">
                <label class="form-label">Total (€)</label>
                <input type="number" step="0.01" name="total" class="form-control"
                       value="{{ old('total', $order->total) }}" required>
            </div>

            {{-- Boutons --}}
            <button type="submit" class="btn btn-success-custom">
                Enregistrer
            </button>

            <a href="{{ route('orders.show', $order->id) }}"
               class="btn btn-secondary">
                Annuler
            </a>
        </form>
    </div>
@endsection
