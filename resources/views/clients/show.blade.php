<div class="container">
        <h1>Détails du client</h1>

        <p><strong>Nom :</strong> {{ $client->nom ?? 'Non renseigné' }}</p>
        <p><strong>Email :</strong> {{ $client->email ?? 'Non renseigné' }}</p>
        <p><strong>Téléphone :</strong> {{ $client->telephone ?? 'Non renseigné' }}</p>
        <p><strong>Adresse :</strong> {{ $client->adresse ?? 'Non renseigné' }}</p>

        <a href="{{ route('clients.index') }}">← Retour à la liste des clients</a>
    </div>
