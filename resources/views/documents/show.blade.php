@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4">
        <h2 class="page-title mb-3">Document</h2>
        <div class="card-custom">
            <p><strong>Nom :</strong> {{ $saveFile->name }}</p>
            <p><strong>Type :</strong> {{ $saveFile->mime_type }}</p>
            <p><strong>Taille :</strong> {{ number_format($saveFile->size / 1024,2) }} KB</p>
            <div class="d-flex justify-content-start align-items-center gap-3">

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

                    <button type="submit" class="btn-warning-custom">
                        {{ $saveFile->is_public ? 'Rendre privé' : 'Partager' }}
                    </button>
                </form>

            </div>

            @if($saveFile->is_public)
                <div class="mt-4">
                    <label class="form-label">Lien de partage</label>

                    <div class="input-group">
                        <input id="shareLink"
                               type="text"
                               class="form-control"
                               value="{{ route('save-files.shared', $saveFile->share_token) }}"
                               readonly>

                        <button type="button"
                                class="btn-primary-custom"
                                onclick="copyLink()">
                            Copier
                        </button>
                    </div>
                </div>
            @endif
            </div>
        </div>
    <script>
        function copyLink() {
            const copyText = document.getElementById("shareLink");

            copyText.select();
            copyText.setSelectionRange(0, 99999);

            document.execCommand("copy");

            alert("Lien copié !");
        }
    </script>
@endsection
