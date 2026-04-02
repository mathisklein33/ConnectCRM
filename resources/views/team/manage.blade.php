@extends('layouts.app')

@section('content')
    <div class="dmd-wrapper">
        <div class="dmd-header">
            <div>
                <h1 class="dmd-page-title">Gestion de l'Équipe</h1>
                <p class="dmd-subtitle">Administrez les membres et leurs accès aux schedules.</p>
            </div>
        </div>

        <div class="dmd-card" style="margin-bottom: 2rem; padding: 2rem;">
            <div class="dmd-view-section-title">Chef d'équipe (Vous)</div>
            <div style="display: flex; align-items: center; gap: 25px;">
                <div class="big-avatar" style="margin: 0; width: 70px; height: 70px; font-size: 1.5rem;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="header-info-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; flex-grow: 1;">
                    <div class="detail-group">
                        <label>Nom</label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="detail-group">
                        <label>Email</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <div class="detail-group">
                        <label>Rôle Global</label>
                        <p><span class="dmd-badge dmd-badge-traitee">{{ auth()->user()->role->name }}</span></p>
                    </div>
                    <div class="detail-group">
                        <label>Total Membres</label>
                        <p>{{ $teamUsers->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="dmd-card" style="margin-bottom: 2rem; padding: 2rem;">
            <div class="dmd-view-section-title">Ajouter un nouveau membre</div>
            <form action="{{ route('team.add-user') }}" method="POST" class="dmd-crea-form">
                @csrf
                <input type="hidden" name="team_id" value="{{ $teamId }}">

                <div class="dmd-crea-row">
                    <div class="dmd-crea-flex-2 dmd-crea-group">
                        <label class="dmd-crea-label">Choisir un utilisateur</label>
                        <select name="user_id" class="dmd-crea-input" required>
                            <option value="" disabled selected>Sélectionner dans la liste...</option>
                            @foreach($allUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="dmd-crea-flex-2 dmd-crea-group">
                        <label class="dmd-crea-label">Rôle</label>
                        <select name="role" class="dmd-crea-input" required>
                            <option value="member">Membre</option>
                            <option value="editor">Éditeur</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div style="display: flex; align-items: flex-end;">
                        <button type="submit" class="btn-primary-custom" style="padding: 0.85rem 2rem;">
                            Ajouter au groupe
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="dmd-card">
            <table class="dmd-table">
                <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Rôle</th>
                    <th>Date d'entrée</th>
                    <th class="dmd-actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teamUsers as $item)
                    <tr>
                        <td>
                            <div class="dmd-client-info">
                                <span class="dmd-client-name">{{ $item->user->name }}</span>
                                <span class="dmd-client-email">{{ $item->user->email }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="dmd-date">{{ $item->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="dmd-actions">
                            <form action="{{ route('team.remove-user', $item->id) }}" method="POST" onsubmit="return confirm('Retirer ce membre de l\'équipe ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dmd-btn-icon" style="color: #ef4444;">
                                    <i class="fas fa-trash-alt"></i> <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
