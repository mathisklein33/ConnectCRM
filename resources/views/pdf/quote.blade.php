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

        .table-quote {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table-quote th, .table-quote td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        .table-quote th {
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
    <table>
    <tr>
        <td>
            <p>ConnectCRM</p>

            <p>SAS au capital de 15 000 €</p>

            <p>42 Avenue des Horizons, 75008 Paris, France</p>

            <p>SIRET : 802 911 345 00021</p>

            <p>N° TVA Intracommunautaire : FR 84 802911345</p>

            <p>contact@connectcrm.test</p>

            <p>01 40 12 34 56</p>


        </td>
        <td>
            <img src="{{ public_path('img/crm-logo.png') }}" class="align-to-right" alt="logo du site" style="height: 200px;">
        </td>
    </tr>
    </table>

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

    <table class="table-quote">
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
