@extends('layouts.app')

@section('content')
    <h1>Modifier le devis</h1>

    <form action="{{ route('quotes.update', $quote->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Numéro</label>
            <input type="text" name="number" value="{{ old('number', $quote->number) }}">
        </div>

        <div>
            <label>Client</label>
            <select name="client_id">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $quote->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Total</label>
            <input type="text" name="total" value="{{ old('total', $quote->total) }}">
        </div>

        <div>
            <label>Statut</label>
            <input type="text" name="status" value="{{ old('status', $quote->status) }}">
        </div>

        <button type="submit">Enregistrer</button>
    </form>
@endsection
