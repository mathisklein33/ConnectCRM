@extends('layouts.app')
@section('content')

    <div class="container-fluid contracts-page p-4">
        <h2 class="page-title mb-4">Détail du contrat</h2>
        <div class="card-custom">
            <div class="row g-3">
                <div class="col-md-6">
                    <strong>ID :</strong>
                    <div class="detail-value">{{ $contract->id }}</div>
                </div>
                <div class="col-md-6">
                    <strong>Client :</strong>
                    <div class="detail-value">
                        {{ $contract->client->name ?? 'Aucun client' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Titre :</strong>
                    <div class="detail-value">
                        {{ $contract->title ?? 'Sans titre' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Montant :</strong>
                    <div class="detail-value">
                        {{ $contract->amount ?? 'Non défini' }}
                    </div>
                </div>
            </div>
            <div class=" d-flex justify-content-between align-items-center pt-3">
                <a href="{{ route('contracts.index') }}" class="btn-retour">
                    ← retour
                </a>
            </div>
        </div>
    </div>

@endsection
