@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4">
        <h2 class="page-title mb-3">Modifier le document</h2>
        <div class="card-custom">
            <form action="{{ route('save-files.update', $saveFile->id) }}"
                  method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nom du fichier</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $saveFile->name }}"
                           required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $saveFile->mime_type }}"
                           disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Taille</label>
                    <input type="text"
                           class="form-control"
                           value="{{ number_format($saveFile->size / 1024,2) }} KB"
                           disabled>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('save-files.index') }}"
                       class="btn-retour">
                        ← retour
                    </a>
                    <button type="submit"
                            class="btn-primary-custom">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
