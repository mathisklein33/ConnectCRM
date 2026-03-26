@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h2 class="page-title">
            Planning — {{ $team->name }}
        </h2>
        <div class="card-custom">
            <div class="planning-grid">
                <div class="planning-day">
                    <div class="planning-header">Lundi</div>
                    <div class="planning-slot">08:00 - 12:00</div>
                    <div class="planning-slot">13:00 - 17:00</div>
                </div>
                <div class="planning-day">
                    <div class="planning-header">Mardi</div>
                    <div class="planning-slot">08:00 - 12:00</div>
                    <div class="planning-slot">13:00 - 17:00</div>
                </div>
                <div class="planning-day">
                    <div class="planning-header">Mercredi</div>
                </div>
                <div class="planning-day">
                    <div class="planning-header">Jeudi</div>
                </div>
                <div class="planning-day">
                    <div class="planning-header">Vendredi</div>
                </div>
            </div>
        </div>
    </div>

@endsection
