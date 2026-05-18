@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold mb-1">Modifier un rôle</h2>
            <p class="text-muted mb-0">Mettez à jour les informations du rôle.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nom du rôle</label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $role->slug) }}"
                                   class="form-control @error('slug') is-invalid @enderror">
                            @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Enregistrer</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Annuler</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
