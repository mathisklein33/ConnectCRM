@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4 contracts-page">
        <h2 class="page-title mb-4">Créer un contrat</h2>
        <div class="card-custom">
            <form action="{{ route('contracts.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-control" required>
                            <option value="">-- Choisir un client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Numéro du contrat</label>
                        <input type="text" name="number" class="form-control"
                               value="{{ old('number') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Contenu du contrat</label>
                        <textarea name="content" rows="6" class="form-control">{{ old('content') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="start_date" class="form-control"
                               value="{{ old('start_date') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="end_date" class="form-control"
                               value="{{ old('end_date') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="total"
                               class="form-control"
                               value="{{ old('total') }}" required>
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('contracts.index') }}" class="btn-retour">
                        ← retour
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
