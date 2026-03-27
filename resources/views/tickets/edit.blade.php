@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h2 class="mb-4">Modifier ticket</h2>
        <div class="card dashboard-card">
            <form action="{{ route('tickets.update',$ticket->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('tickets._form')
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('tickets.index') }}" class="btn-retour">
                        ← retour
                    </a>
                <button class="btn btn-primary mt-3">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

@endsection
