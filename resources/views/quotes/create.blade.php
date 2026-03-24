
<h2>Créer un devis</h2>

    <form action="{{ route('quotes.store') }}" method="POST">
@csrf

<div>
    <label for="client_id">Client</label>
    <select name="client_id" id="client_id" required>
        <option value="">-- Choisir un client --</option>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
            </option>
        @endforeach
    </select>
    @error('client_id')
    <div>{{ $message }}</div>
    @enderror
</div>

<br>

<div>
    <label for="number">Numéro du devis</label>
    <input type="text" name="number" id="number" value="{{ old('number') }}" required>
    @error('number')
    <div>{{ $message }}</div>
    @enderror
</div>

<br>

<div>
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}" required>
    @error('title')
    <div>{{ $message }}</div>
    @enderror
</div>

<br>

<div>
    <label for="total">Total</label>
    <input type="number" step="0.01" name="total" id="total" value="{{ old('total') }}" required>
    @error('total')
    <div>{{ $message }}</div>
    @enderror
</div>

<br>

<div>
    <label for="status">Statut</label>
    <select name="status" id="status">
        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
        <option value="sent" {{ old('status') == 'sent' ? 'selected' : '' }}>Envoyé</option>
        <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>Accepté</option>
    </select>
    @error('status')
    <div>{{ $message }}</div>
    @enderror
</div>

<br>

<button type="submit">Enregistrer</button>
</form>
