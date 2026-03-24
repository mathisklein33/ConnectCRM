@extends('layouts.app')

@section('content')
    <h1>Modifier le contrat</h1>

    <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Titre</label>
            <input type="text" name="title" value="{{ old('title', $contract->title) }}">
        </div>

        <div>
            <label>Client</label>
            <select name="client_id">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $contract->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Montant</label>
            <input type="text" name="amount" value="{{ old('amount', $contract->amount) }}">
        </div>

        <div>
            <label>Statut</label>
            <input type="text" name="status" value="{{ old('status', $contract->status) }}">
        </div>

        <button type="submit">Enregistrer</button>
    </form>
@endsection
