@extends('layouts.app')

@section('content')
    <h2>Créer un contrat</h2>

    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf

        <div>
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" required>
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="number">Numéro du contrat</label>
            <input type="text" name="number" id="number" value="{{ old('number') }}" required>
            @error('number')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="content">Contenu du contrat</label>
            <textarea name="content" id="content" rows="8">{{ old('content') }}</textarea>
            @error('content')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="start_date">Date de début</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}">
            @error('start_date')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="end_date">Date de fin</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}">
            @error('end_date')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" id="total" value="{{ old('total') }}" required>
            @error('total')
            <div>{{ $message }}</div>
            @enderror
        </div>


        <button type="submit">Enregistrer</button>
    </form>
@endsection
