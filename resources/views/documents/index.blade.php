@extends('layouts.app')
@section('content')

    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="page-title">Documents</h2>
            <a href="{{ route('save-files.create') }}" class="btn-primary-custom">
                + Ajouter
            </a>
        </div>
        <div class="card-custom">
            <table class="ticket-table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Taille</th>
                    <th>Partage</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($files as $file)
                    <tr>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->mime_type }}</td>
                        <td>{{ number_format($file->size / 1024, 2) }} KB</td>
                        <td>
                            @if($file->is_public)
                                <span class="status status-valid">Public</span>
                            @else
                                <span class="status status-open">Privé</span>
                            @endif
                        </td>
                        <td class="text-end d-flex gap-2">
                            <a href="{{ route('save-files.show',$file->id) }}"
                               class="btn-info-custom">
                                Voir
                            </a>
                            <a href="{{ route('save-files.download',$file->id) }}"
                               class="btn-secondary-custom">
                                Télécharger
                            </a>
                            <a href="{{ route('save-files.edit',$file->id) }}"
                               class="btn-warning-custom">
                                Modifier
                            </a>
                            <form action="{{ route('save-files.destroy',$file->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger-custom">
                                    Supprimer
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Aucun document
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
