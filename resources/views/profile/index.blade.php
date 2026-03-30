@extends('layouts.app')

@section('content')
    <div id="profile-container" class="d-flex justify-content-center align-items-start min-vh-100 pt-5">
        <div class="profile-card">
            <div class="profile-card-header">
            <span class="header-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </span>
                Information profil
            </div>

            <div class="profile-card-body">
                <div class="avatar-section">
                    <div class="avatar-circle">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="info-section">
                    <div class="info-grid">
                        <div class="info-group">
                            <label>Nom complet</label>
                            <div class="value">{{ $user->name }}</div>
                        </div>

                        <div class="info-group">
                            <label>Adresse Email</label>
                            <div class="value">{{ $user->email }}</div>
                        </div>

                        <div class="info-group">
                            <label>Date de création</label>
                            <div class="value">{{ $user->created_at->format('d/m/Y') }}</div>
                        </div>

                        <div class="info-group">
                            <label>Rôle / Accès</label>
                            <div class="value">
                                <span class="role-badge">{{ $user->role->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-card-footer">
                <a href="{{ route('profile.edit') }}" class="btn-edit">
                    Modifier les informations
                </a>
            </div>
        </div>
    </div>
@endsection
