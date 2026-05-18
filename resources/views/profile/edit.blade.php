@extends('layouts.app')

@section('content')

    <div class="dmd-crea-wrapper">
        <div class="dmd-crea-card">
            <div class="dmd-crea-header">
                <h2 class="dmd-crea-title">{{ __('Paramètres du Compte') }}</h2>
            </div>

            <div class="dmd-crea-form">

                {{-- Section: Informations de profil --}}
                <div class="card-custom">
                    <div class="form-card">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Section: Mot de passe --}}
                <div class="card-custom">
                    <div class="form-card">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Section: Suppression --}}
                <div class="card-custom" style="border-left: 4px solid #EF4444;">
                    <div class="form-card">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
