@extends('layouts.app')

@section('content')
    <h1>Modifier la facture</h1>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Numéro</label>
            <input type="text" name="number" value="{{ old('number', $invoice->number) }}">
        </div>

        <div>
            <label>Client</label>
            <select name="client_id">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Total</label>
            <input type="text" name="total" value="{{ old('total', $invoice->total) }}">
        </div>

        <div>
            <label>Statut</label>
            <input type="text" name="status" value="{{ old('status', $invoice->status) }}">
        </div>

        <button type="submit">Enregistrer</button>
    </form>
@endsection
