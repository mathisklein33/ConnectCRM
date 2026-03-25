@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h2 class="mb-4">Modifier ticket</h2>
        <div class="card dashboard-card">
            <form action="{{ route('tickets.update',$ticket->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('tickets._form')
                <button class="btn mt-3">Mettre à jour</button>
            </form>
        </div>
    </div>

@endsection
