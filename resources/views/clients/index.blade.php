
<h1>Clients</h1>
<ul>
    @foreach($clients as $client)
        <li>{{ $client->nom }} - {{ $client->email }}</li>
        <a href="/interactions/create/{{$client->id}}">Ajouter une intéraction</a>
    @endforeach
</ul>

<a href="/interactions"> Voir les interactions</a>

