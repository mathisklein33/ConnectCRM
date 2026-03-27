@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Tableau de bord des statistiques commerciales</h2>
        </div>

        <!-- KPIs -->
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">CA gagné</h6>
                        <h3>{{ number_format($totalWonRevenue ?? 0, 2, ',', ' ') }} €</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Pipeline total</h6>
                        <h3>{{ number_format($totalPipelineRevenue ?? 0, 2, ',', ' ') }} €</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Pipeline pondéré</h6>
                        <h3>{{ number_format($weightedPipelineRevenue ?? 0, 2, ',', ' ') }} €</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Taux de conversion</h6>
                        <h3>{{ $conversionRate ?? 0 }} %</h3>
                    </div>
                </div>
            </div>

        </div>

        <!-- 📊 GRAPHE -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Chiffre d’affaires mensuel</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Tables -->
        <div class="row g-4 mb-4">

            <!-- Étapes -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Opportunités par étape</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                            <tr>
                                <th>Étape</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stageStats ?? [] as $stage)
                                <tr>
                                    <td>{{ $stage->stage }}</td>
                                    <td>{{ $stage->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        Aucune donnée disponible
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Prochaines clôtures -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Prochaines clôtures</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                            <tr>
                                <th>Opportunité</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Montant</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($upcomingClosings ?? [] as $opportunity)
                                <tr>
                                    <td>{{ $opportunity->title }}</td>
                                    <td>{{ $opportunity->client->name ?? '-' }}</td>
                                    <td>
                                        {{ optional($opportunity->expected_closing_date)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        {{ number_format($opportunity->total_amount ?? 0, 2, ',', ' ') }} €
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Aucune clôture à venir
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Top produits -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Top produits</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th>SKU</th>
                        <th>Quantité vendue</th>
                        <th>Revenu généré</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($topProducts ?? [] as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->total_quantity }}</td>
                            <td>{{ number_format($product->total_revenue, 2, ',', ' ') }} €</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Aucun produit vendu
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- 📊 SCRIPT GRAPHIQUE -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = @json($labels ?? []);
        const data = @json($values ?? []);

        const ctx = document.getElementById('revenueChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'CA (€)',
                    data: data,
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

@endsection
