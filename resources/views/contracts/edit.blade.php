@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4 contracts-page">
        <h2 class="page-title mb-4">Modifier le contrat</h2>
        <div class="card-custom">
            <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title"
                               class="form-control"
                               value="{{ old('title', $contract->title) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $contract->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Montant</label>
                        <input type="text" name="amount"
                               class="form-control"
                               value="{{ old('amount', $contract->amount) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <input type="text" name="status"
                               class="form-control"
                               value="{{ old('status', $contract->status) }}">
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
