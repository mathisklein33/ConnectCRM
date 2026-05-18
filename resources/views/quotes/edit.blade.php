@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4 quotes-page">
        <div class="page-header">
            <h2 class="page-title">Modifier le devis</h2>
        </div>
        <div class="card-custom form-card">
            <form action="{{ route('quotes.update', $quote->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Numéro</label>
                    <input type="text" name="number"
                           class="form-control-custom"
                           value="{{ old('number', $quote->number) }}">
                </div>
                <div class="form-group">
                    <label>Client</label>
                    <select name="client_id" class="form-control-custom">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ $quote->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" name="total"
                           class="form-control-custom"
                           value="{{ old('total', $quote->total) }}">
                </div>
                <div class="form-group">
                    <label>Statut</label>
                    <input type="text" name="status"
                           class="form-control-custom"
                           value="{{ old('status', $quote->status) }}">
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('quotes.index') }}" class="btn-retour">
                        ← retour
                    </a>
                    <button class="btn-primary-custom">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

@endsection
