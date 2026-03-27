@extends('layouts.app')

@section('content')

    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Ajouter une vente</h2>

            <a href="{{ route('sales_statistics.index') }}" class="btn btn-secondary">
                Retour
            </a>
        </div>

        <!-- Erreurs -->
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Erreur :</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('sales_statistics.store') }}" method="POST">
                    @csrf

                    <!-- Client -->
                    <div class="mb-3">
                        <label class="form-label">Client</label>
                        <select name="client_id" class="form-control" required>
                            <option value="">-- Choisir un client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Montant -->
                    <div class="mb-3">
                        <label class="form-label">Montant (€)</label>
                        <input type="number" step="0.01" name="amount" class="form-control"
                               value="{{ old('amount') }}" required>
                    </div>

                    <!-- Quantité -->
                    <div class="mb-3">
                        <label class="form-label">Quantité</label>
                        <input type="number" name="sales_count" class="form-control"
                               value="{{ old('sales_count', 1) }}">
                    </div>

                    <!-- Date -->
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="datetime-local" name="date" class="form-control"
                               value="{{ old('date') }}" required>
                    </div>

                    <!-- Total dynamique -->
                    <div class="mb-3">
                        <label class="form-label">Total estimé</label>
                        <input type="text" id="total" class="form-control" disabled>
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn btn-success">
                        Enregistrer
                    </button>

                </form>

            </div>
        </div>

    </div>

    <!-- Script calcul automatique -->
    <script>
        const amountInput = document.querySelector('input[name="amount"]');
        const countInput = document.querySelector('input[name="sales_count"]');
        const totalField = document.getElementById('total');

        function updateTotal() {
            const amount = parseFloat(amountInput.value) || 0;
            const count = parseInt(countInput.value) || 1;

            totalField.value = (amount * count).toFixed(2) + ' €';
        }

        amountInput.addEventListener('input', updateTotal);
        countInput.addEventListener('input', updateTotal);

        updateTotal();
    </script>

@endsection
