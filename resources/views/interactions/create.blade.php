
    <h1>Nouvelle interaction pour {{ $client->nom }}</h1>

    <form method="POST" action="{{ route('interactions.store') }}">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id }}">

        <label>Type :</label>
        <select name="type" required>
            <option value="appel">Appel</option>
            <option value="email">Email</option>
            <option value="rendez-vous">RDV</option>
        </select>

        <label>Date :</label>
        <input type="date" name="date" required>

        <label>Sujet :</label>
        <input type="text" name="sujet">

        <label>Contenu :</label>
        <textarea name="contenu"></textarea>

        <button type="submit">Ajouter</button>
    </form>
