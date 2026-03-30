@extends('layouts.app')

@section('content')
    <style>
        /* Variables pour une cohérence parfaite */
#profile-page-wrapper {
            background-color: #F3F4F6;
            min-height: 100vh;
            padding: 3rem 1rem;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }

        .profile-header {
            max-width: 80rem;
            margin: 0 auto 2rem auto;
            padding: 0 1.5rem;
        }

        .profile-header h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(#111827);
            letter-spacing: -0.025em;
        }

        .profile-section-container {
            max-width: 80rem;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .profile-card {
            background-color: white;
            outline: none;

            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: black;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        /* Style pour les titres à l'intérieur des formulaires inclus */
        .profile-card h2 {
            color: #111827;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            background-color: white;
        }

        .profile-card p {
            color: black;
            background-color: white;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        /* Conteneur interne des formulaires */
        .form-inner-container {
            max-width: 32rem; /* Équivalent à max-w-xl */
        }

        /* Séparateur subtil */
        .profile-card:not(:last-child) {
            margin-bottom: 1rem;
        }

        @media (min-width: 640px) {
            .profile-card {
                padding: 2.5rem;
            }
        }         /* 1. On enlève le fond bleu "moche" et on stylise proprement l'en-tête */
         .profile-form-header {
             background-color: transparent; /* Supprime le bloc bleu */
             padding: 0 0 1.5rem 0;
             border-bottom: 1px solid #e5e7eb;
             margin-bottom: 2rem;
         }

        .profile-form-header h2 {
            color: #111827; /* Texte sombre et élégant */
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .profile-form-header p {
            color: #6b7280; /* Texte gris doux pour la description */
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* 2. On aligne les labels pour que ce soit droit */
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-row label {
            width: 100px; /* Aligne tous les champs verticalement */
            font-weight: 500;
            color: #374151;
        }

        /* 3. On stylise les inputs pour enlever le look "Windows 95" */
        .form-row input {
            flex: 1;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-row input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>

    <div id="profile-page-wrapper">
        <div class="profile-header">
            <h2>{{ __('Paramètres du Compte') }}</h2>
        </div>

        <div class="profile-section-container">

            {{-- Section: Informations de profil --}}
            <div class="profile-card">
                <div class="form-inner-container">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Section: Mot de passe --}}
            <div class="profile-card">
                <div class="form-inner-container">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Section: Suppression --}}
            <div class="profile-card" style="border-left: 4px solid #EF4444;">
                <div class="form-inner-container">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection
