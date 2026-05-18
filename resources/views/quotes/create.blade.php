@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4 quotes-page">
        <div class="page-header">
            <h2 class="page-title">Créer un devis</h2>
        </div>
        <div class="card-custom form-card">
            <form action="{{ route('quotes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Client</label>
                    <select name="client_id" class="form-control-custom" required>
                        <option value="">-- Choisir un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Numéro du devis</label>
                    <input type="text" name="number" class="form-control-custom"
                           value="{{ old('number') }}" required>
                    @error('number')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="title" class="form-control-custom"
                           value="{{ old('title') }}" required>
                    @error('title')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" step="0.01" name="total"
                           class="form-control-custom"
                           value="{{ old('total') }}" required>
                    @error('total')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Statut</label>
                    <select name="status" class="form-control-custom">
                        <option value="draft">Brouillon</option>
                        <option value="sent">Envoyé</option>
                        <option value="accepted">Accepté</option>
                    </select>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('quotes.index') }}" class="btn-retour">
                        ← retour
                    </a>
                    <button class="btn-primary-custom">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

@endsection
