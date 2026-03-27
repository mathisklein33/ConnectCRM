<h1>Créer une facture</h1>

<form action="{{ route('invoices.store') }}" method="POST">
    @csrf

    <label>Client :</label>
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>

    <br><br>

    <label>Numéro :</label>
    <input type="text" name="number" required>

    <br><br>

    <label>Total :</label>
    <input type="number" step="0.01" name="total" required>

    <br><br>

    <label>Status :</label>
    <select name="status">
        <option value="unpaid">Non payé</option>
        <option value="paid">Payé</option>
    </select>

    <br><br>

    <button type="submit">Créer</button>
</form>
