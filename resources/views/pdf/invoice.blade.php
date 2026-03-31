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

       .table-invoice {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table-invoice th,
        .table-invoice td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
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
<h1>Facture {{ $invoice->number }}</h1>

<p><strong>Client :</strong> {{ optional($invoice->client)->name ?? 'Client supprimé' }}</p>
<div class="quote-info box">
<table class="table-invoice">
    <thead>
    <tr>
        <th>Total</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ number_format((float) $invoice->total, 2, ',', ' ') }} €</td>
        <td>{{ $invoice->status }}</td>
    </tr>
    </tbody>
</table>
</div>
</body>
</html>
