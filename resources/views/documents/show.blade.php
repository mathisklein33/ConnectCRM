@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4">
        <h2 class="page-title mb-3">Document</h2>
        <div class="card-custom">
            <p><strong>Nom :</strong> {{ $saveFile->name }}</p>
            <p><strong>Type :</strong> {{ $saveFile->mime_type }}</p>
            <p><strong>Taille :</strong> {{ number_format($saveFile->size / 1024,2) }} KB</p>
            <div class=" d-flex justify-content-start align-items-center gap-3">
                <a href="{{ route('save-files.index') }}" class="btn-retour">
                    ← retour
                </a>
                <a href="{{ route('save-files.download',$saveFile->id) }}"
                   class="btn-secondary-custom">
                    Télécharger
                </a>
                <form method="POST"
                      action="{{ route('save-files.toggle-share',$saveFile->id) }}">
                    @csrf
                    <button class="btn-warning-custom">
                        Toggle partage
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
