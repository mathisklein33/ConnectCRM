<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Devis {{ $quote->number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #222;
            margin: 30px;
        }

        .header,
        .client-info,
        .quote-info,
        .footer {
            width: 100%;
            margin-bottom: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .box {
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="title">Devis</div>
    <p><strong>Numéro :</strong> {{ $quote->number }}</p>
    <p><strong>Date :</strong> {{ $quote->created_at?->format('d/m/Y') }}</p>
    <p><strong>Statut :</strong> {{ $quote->status }}</p>
</div>

<div class="client-info box">
    <div class="section-title">Informations client</div>
    <p><strong>Nom :</strong> {{ $quote->client->name ?? '' }}</p>
    <p><strong>Email :</strong> {{ $quote->client->email ?? '' }}</p>
    <p><strong>Adresse :</strong> {{ $quote->client->adresse ?? '' }}</p>
    <p><strong>Ville :</strong> {{ $quote->client->ville ?? '' }}</p>
    <p><strong>Code postal :</strong> {{ $quote->client->code_postal ?? '' }}</p>
    <p><strong>Téléphone :</strong> {{ $quote->client->telephone ?? '' }}</p>
</div>

<div class="quote-info box">
    <div class="section-title">Détails du devis</div>
    <p><strong>Titre :</strong> {{ $quote->title }}</p>

    <table>
        <thead>
        <tr>
            <th>Désignation</th>
            <th>Montant</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $quote->title }}</td>
            <td>{{ number_format($quote->total, 2, ',', ' ') }} €</td>
        </tr>
        </tbody>
    </table>

    <div class="total">
        Total : {{ number_format($quote->total, 2, ',', ' ') }} €
    </div>
</div>

<div class="footer">
    Merci pour votre confiance.
</div>

</body>
</html>
