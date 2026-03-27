@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Détail de la commande</h1>

        {{-- Message succès --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Commande {{ $order->number }}
            </div>

            <div class="card-body">

                <p><strong>ID :</strong> {{ $order->id }}</p>

                <p><strong>Client :</strong>
                    {{ $order->client->name ?? '-' }}
                </p>

                <p><strong>Devis associé :</strong>
                    @if($order->quote)
                        DEV-{{ $order->quote->id }}
                    @else
                        Aucun
                    @endif
                </p>

                <p><strong>Total :</strong>
                    {{ number_format($order->total, 2, ',', ' ') }} €
                </p>

                <p><strong>Date :</strong>
                    {{ $order->created_at->format('d/m/Y H:i') }}
                </p>

            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-3">
            <a href="{{ route('orders.index') }}" class="btn btn-retour">
                Retour
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
        </div>
    </div>
@endsection
