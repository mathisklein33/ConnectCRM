@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des commandes</h1>

        {{-- Message succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Bouton créer --}}
        <a href="{{ route('orders.create') }}" class="btn btn-primary-custom mb-3">
            + Nouvelle commande
        </a>

        {{-- Tableau --}}
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Devis</th>
                <th>Total (€)</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>

                    <td>
                        <strong>{{ $order->number }}</strong>
                    </td>

                    <td>
                        {{ $order->client->name ?? '-' }}
                    </td>

                    <td>
                        @if($order->quote)
                            DEV-{{ $order->quote->id }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        {{ number_format($order->total, 2, ',', ' ') }} €
                    </td>

                    <td>
                        {{ $order->created_at->format('d/m/Y') }}
                    </td>

                    <td>
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="btn btn-info-custom">
                            Voir
                        </a>

                        <a href="{{ route('orders.edit', $order->id) }}"
                           class="btn btn-warning-custom">
                            Modifier
                        </a>

                        <form action="{{ route('orders.destroy', $order->id) }}"
                              method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger-custom"
                                    onclick="return confirm('Supprimer cette commande ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Aucune commande trouvée
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
