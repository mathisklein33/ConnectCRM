@extends('layouts.app')
@section('content')

    <div class="container-fluid invoices-page p-4">
        <h2 class="page-title mb-4">Modifier la facture</h2>
        <div class="card-custom">
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Numéro</label>
                        <input type="text" name="number"
                               class="form-control"
                               value="{{ old('number', $invoice->number) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-control">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total</label>
                        <input type="text" name="total"
                               class="form-control"
                               value="{{ old('total', $invoice->total) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <input type="text" name="status"
                               class="form-control"
                               value="{{ old('status', $invoice->status) }}">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('invoices.index') }}" class="btn-retour">
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
