    <h1>Liste des interactions</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <ul>
        @forelse($interactions as $interaction)
            <li>
                <a href="{{ route('interactions.show', $interaction->id) }}">
                   {{$interaction->client->nom}} - {{ $interaction->type }} - {{ $interaction->sujet ?? 'Sans sujet' }} ({{ $interaction->date }})
                </a>
            </li>
        @empty
            <li>Aucune interaction trouvée.</li>
        @endforelse
    </ul>
    <a href="/clients"> Voir les clients</a>

