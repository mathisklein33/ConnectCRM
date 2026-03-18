
<h1>Clients</h1>
<ul>
    @foreach($clients as $client)
        <li>{{ $client->nom }} - {{ $client->email }}</li>
        <a href="/clients/{{$client->id}}">Voir le profil</a>
        <a href="/interactions/create/{{$client->id}}">A∞jouter une intéraction</a>
        <a href="/interactions/client/{{$client->id}}">Voir intéraction</a>

    @endforeach
</ul>

<a href="/interactions"> Voir les interactions</a>

