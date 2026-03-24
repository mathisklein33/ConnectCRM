<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $invoice->number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            margin: 6px 0;
        }
    </style>
</head>
<body>
<h1>Facture {{ $invoice->number }}</h1>

<p><strong>ID :</strong> {{ $invoice->id }}</p>
<p><strong>Client :</strong> {{ optional($invoice->client)->name ?? 'Client supprimé' }}</p>
<p><strong>Total :</strong> {{ number_format((float) $invoice->total, 2, ',', ' ') }} €</p>
<p><strong>Statut :</strong> {{ $invoice->status }}</p>
</body>
</html>
