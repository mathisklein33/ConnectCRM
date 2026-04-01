@extends('layouts.app')

@section('content')

    <div class="container-fluid p-4">

        <h2 class="page-title mb-3">Document partagé</h2>

        <div class="card-custom">

            <p><strong>Nom :</strong> {{ $saveFile->name }}</p>
            <p><strong>Type :</strong> {{ $saveFile->mime_type }}</p>
            <p><strong>Taille :</strong> {{ number_format($saveFile->size / 1024,2) }} KB</p>

            <div class="mt-3">
                <a href="{{ route('save-files.shared.download', $saveFile->share_token) }}"
                   class="btn-primary-custom">
                    Télécharger
                </a>
            </div>

        </div>

    </div>

@endsection
