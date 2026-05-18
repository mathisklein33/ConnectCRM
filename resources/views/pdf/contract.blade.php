<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat {{ $contract->number }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #222;
            margin: 30px;
        }

        .header {
            margin-bottom: 20px;
        }

        .title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 12px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content {
            border: 1px solid #444;
            padding: 10px;
            min-height: 100px;
            white-space: pre-line;
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

{{-- HEADER --}}
<div class="header">
    <div class="title">Contrat</div>
    <p><strong>Numéro :</strong> {{ $contract->number }}</p>
    <p><strong>Date :</strong> {{ $contract->created_at?->format('d/m/Y') }}</p>
</div>

{{-- CLIENT --}}
<div class="box">
    <div class="section-title">Client</div>

    <p><strong>Nom :</strong> {{ $contract->client->name ?? '' }}</p>
    <p><strong>Email :</strong> {{ $contract->client->email ?? '' }}</p>
    <p><strong>Adresse :</strong> {{ $contract->client->adresse ?? '' }}</p>
    <p><strong>Ville :</strong> {{ $contract->client->ville ?? '' }}</p>
    <p><strong>Code postal :</strong> {{ $contract->client->code_postal ?? '' }}</p>
    <p><strong>Téléphone :</strong> {{ $contract->client->telephone ?? '' }}</p>
</div>

{{-- INFOS CONTRAT --}}
<div class="box">
    <div class="section-title">Informations du contrat</div>

    <p><strong>Titre :</strong> {{ $contract->title }}</p>
    <p><strong>Date début :</strong> {{ $contract->start_date }}</p>
    <p><strong>Date fin :</strong> {{ $contract->end_date }}</p>

    @if(isset($contract->total))
        <p><strong>Montant :</strong> {{ number_format($contract->total, 2, ',', ' ') }} €</p>
    @endif
</div>

{{-- CONTENU --}}
<div class="box">
    <div class="section-title">Contenu du contrat</div>

    <div class="content">
        {{ $contract->content }}
    </div>
</div>

{{-- FOOTER --}}
<div class="footer">
    Document généré automatiquement - {{ date('Y') }}
</div>

</body>
</html>
