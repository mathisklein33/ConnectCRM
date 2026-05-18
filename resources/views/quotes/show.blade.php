@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4">
        <div class="page-header">
            <h2 class="page-title">Détail du devis</h2>
        </div>
        <div class="card-custom detail-card">
            <div class="detail-row">
                <span class="detail-label">ID</span>
                <span class="detail-value">{{ $quote->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Numéro</span>
                <span class="detail-value">{{ $quote->number ?? 'Non défini' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Client</span>
                <span class="detail-value">{{ optional($quote->client)->name ?? 'Client supprimé' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total</span>
                <span class="detail-value">
                {{ number_format((float) ($quote->total ?? 0), 2, ',', ' ') }} €
            </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Statut</span>
                <span class="detail-value status status-open">
                {{ $quote->status ?? 'Non défini' }}
            </span>
            </div>
            <div class=" d-flex justify-content-between align-items-center pt-3">
                <a href="{{ route('quotes.index') }}" class="btn-retour">
                    ← retour
                </a>
                <div class="d-flex p-3 gap-3">
                <a href="{{ route('quotes.edit', $quote->id) }}" class="btn-warning-custom">
                    Modifier
                </a>
                <a href="{{ route('quotes.pdf', $quote->id) }}" class="btn-secondary-custom">
                    Télécharger PDF
                </a>
                </div>
            </div>
        </div>
    </div>

@endsection
