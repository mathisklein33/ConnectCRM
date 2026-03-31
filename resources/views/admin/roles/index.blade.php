@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Gestion des rôles</h2>
                <p class="text-muted mb-0">Créer, modifier et organiser les rôles utilisateurs.</p>
            </div>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary rounded-pill px-4">
                + Nouveau rôle
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-4">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger rounded-4">{{ session('error') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Utilisateurs</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td class="fw-semibold">{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $role->users_count }}</span>
                                </td>
                                <td>{{ $role->created_at?->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill">
                                        Modifier
                                    </a>

                                    <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Supprimer ce rôle ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Aucun rôle trouvé.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
