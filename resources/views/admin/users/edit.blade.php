@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold mb-1">Modifier un utilisateur</h2>
            <p class="text-muted mb-0">Mettez à jour les informations et le rôle.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nom</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nouveau mot de passe</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Laissez vide pour conserver le mot de passe actuel.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Confirmation du mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Rôle</label>
                            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
