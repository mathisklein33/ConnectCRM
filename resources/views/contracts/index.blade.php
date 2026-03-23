@extends('layouts.app')

@section('content')
    <div class="cntrt-wrapper">
        <div class="cntrt-header">
            <h1 class="cntrt-page-title">Gestion des Contrats</h1>
            <a href="#" class="cntrt-btn-add">+ Nouveau contrat</a>
        </div>

        <div class="cntrt-grid">
            @foreach($contracts as $contract)
                <div class="cntrt-card">
                    <div class="cntrt-card-top">
                        <span class="cntrt-badge-client">{{ $contract->client->name }}</span>
                        <h2 class="cntrt-title">{{ $contract->title }}</h2>
                    </div>

                    <div class="cntrt-card-body">
                        <p class="cntrt-description">{{ Str::limit($contract->content, 120) }}</p>

                        <div class="cntrt-info-list">
                            <div class="cntrt-info-item">
                                <span class="cntrt-label">Montant</span>
                                <span class="cntrt-value cntrt-price">{{ number_format($contract->total, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="cntrt-info-item">
                                <span class="cntrt-label">Validité</span>
                                <span class="cntrt-value">
                                {{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}
                                <span class="cntrt-sep">→</span>
                                {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="cntrt-card-footer">
                        <div class="cntrt-meta">
                            Mise à jour : {{ \Carbon\Carbon::parse($contract->updated_at)->format('d/m/Y') }}
                        </div>
                        <div class="cntrt-actions">
                            <a href="#" class="cntrt-action-link cntrt-edit">Modifier</a>
                            <form action="#" method="POST" class="cntrt-inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cntrt-action-link cntrt-delete" onclick="return confirm('Supprimer ce contrat ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
