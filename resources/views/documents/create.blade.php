@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4">
        <h2 class="page-title mb-3">Ajouter un document</h2>
        <div class="card-custom">
            <form action="{{ route('save-files.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Fichier</label>
                    <input type="file"
                           name="document"
                           class="form-control"
                           required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('save-files.index') }}"
                       class="btn-retour">
                        ← retour
                    </a>
                    <button type="submit"
                            class="btn-primary-custom">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
