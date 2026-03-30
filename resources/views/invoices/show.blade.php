@extends('layouts.app')
@section('content')

    <div class="container-fluid invoices-page p-4">
        <h2 class="page-title mb-4">Détail de la facture</h2>
        <div class="card-custom">
            <div class="row g-3">
                <div class="col-md-6">
                    <strong>ID</strong>
                    <div class="detail-value">{{ $invoice->id }}</div>
                </div>
                <div class="col-md-6">
                    <strong>Numéro</strong>
                    <div class="detail-value">
                        {{ $invoice->number ?? 'Non défini' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Client</strong>
                    <div class="detail-value">
                        {{ optional($invoice->client)->name ?? 'Client supprimé' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Total</strong>
                    <div class="detail-value">
                        {{ number_format((float) ($invoice->total ?? 0), 2, ',', ' ') }} €
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Statut</strong>
                    <div class="detail-value">
                        {{ $invoice->status ?? 'Non défini' }}
                    </div>
                </div>
            </div>
            <div class=" d-flex justify-content-start align-items-center pt-3">
                <a href="{{ route('invoices.index') }}" class="btn-retour">
                    ← retour
                </a>
            </div>
        </div>
    </div>

@endsection
