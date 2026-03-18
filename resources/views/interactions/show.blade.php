
    <h1>Détails de l'interaction</h1>

    <p><strong>Client :</strong> {{ $interaction->client->nom }}</p>
    <p><strong>Type :</strong> {{ $interaction->type }}</p>
    <p><strong>Date :</strong> {{ $interaction->date }}</p>
    <p><strong>Sujet :</strong> {{ $interaction->sujet ?? 'Sans sujet' }}</p>
    <p><strong>Contenu :</strong> {{ $interaction->contenu ?? 'Aucun contenu' }}</p>
