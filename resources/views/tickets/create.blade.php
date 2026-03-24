@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h2 class="mb-4">Créer un ticket</h2>
        <div class="card dashboard-card">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                @include('tickets._form')
                <button class="btn btn-primary mt-3">Créer</button>
            </form>
        </div>
    </div>

@endsection
