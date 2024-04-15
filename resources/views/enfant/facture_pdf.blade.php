<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Paiement - {{ $enfant->nom }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Magnolia+Script&display=swap">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .payment-date {
            position: absolute;
            top: 1cm;
            right: 20px;
            font-size: 16px;
        }
        .brand {
            position: absolute;
            top: 1cm;
            left: 20px;
            font-size: 16px;
        }
        .brand span {
            font-size: 20px; /* Adjust font size as needed */
            margin-right: 2px; /* Adjust margin between letters */
            font-family: 'Magnolia Script', cursive; /* Apply Magnolia Script font */
        }
        .p-letter {
            color: #BCDE95; /* Green */
        }
        .t-letter {
            color: #EE9122; /* Orange */
        }
        .i-letter {
            color: #18B5CB; /* Light blue */
        }
        .b-letter {
            color: #E34993; /* Pink */
        }
        .o-letter {
            color: #18B5CB; /* Light blue */
        }
        .header {
            text-align: center;
            margin-top: 2cm; 
            margin-bottom: 20px;
        }
      
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 0;
            font-size: 18px;
        }
        .facture {
            width: 100%;
            font-size: 16px;
        }
        .facture-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .facture-item {
            margin-bottom: 20px;
        }
        .facture-item p {
            margin: 0;
            line-height: 1.5;
        }
        .signature {
            text-align: right;
            margin-top: 0;
        }
        .facture-content {
            margin-top: 0;
        }
        .facture-content .facture {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            padding: 20px;
            page-break-inside: avoid; /* Prevent breaking across pages */
        }
    </style>
</head>
<body>
    <div class="payment-date">Sfax le: {{ now()->format('d/m/Y') }}</div>
    <div class="brand">
        <span class="p-letter">P</span>
        <span class="t-letter">t</span>
        <span class="i-letter">i</span>
        <span class="b-letter">B</span>
        <span class="o-letter">o</span>
        <span class="o-letter">o</span>
    </div>
    <div class="container">
        <div class="header">
            <h1>Facture de Paiement</h1>
        </div>
        <div class="info">
        </div>
        <div class="facture-content">
            <div class="facture">
                <div class="facture-item">
                    @foreach ($paiements as $paiement)
                        <p>La crèche PtiBoo confirme par la présente que {{ $enfant->nom }}, inscrit à notre établissement, a effectué le paiement de sa mensualité pour  {{ $paiement->mois }} / {{ $paiement->annee }}. Ce paiement, d'un montant de {{ $paiement->valeur }} dinars, a été effectué en conformité avec les termes et conditions de notre établissement. Nous tenons à remercier Mrs {{ $enfant->nom_mere }} et Mr {{ $enfant->nom_pere }} pour leur confiance et leur collaboration continue.</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="signature">
            <p>Directrice: Asma Regaieg</p>
        </div>
    </div>
</body>
</html>
