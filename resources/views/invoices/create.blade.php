@extends('layouts.app')
@section('content')

    <div class="container-fluid invoices-page p-4">
        <h2 class="page-title mb-4">Créer une facture</h2>
        <div class="card-custom">
            <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-control" required>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Numéro</label>
                        <input type="text" name="number" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="total"
                               class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-control">
                            <option value="unpaid">Non payé</option>
                            <option value="paid">Payé</option>
                        </select>
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('invoices.index') }}" class="btn-retour">
                        ← retour
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        Créer
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
