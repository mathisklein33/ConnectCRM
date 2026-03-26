@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h2 class="page-title">Créer une équipe</h2>
        <div class="card-custom">
            <form action="{{ route('team.store') }}" method="POST">
                @csrf
                @include('team._form')
                <div class=" d-flex justify-content-between align-items-center">
                    <a href="{{ route('team.index') }}" class="btn-retour">
                        ← retour
                    </a>
                <button class="btn-primary-custom btn-submit">
                    Créer
                </button>
                </div>
            </form>
        </div>
    </div>

@endsection
