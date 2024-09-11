<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste de présence - {{ $monthName }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        p {
            margin-bottom: 5px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h1>Liste de présence - {{ $monthName }}</h1>
    <p>Enfant: {{ $enfant->nom }}</p>
    <table border="1">
        <thead>
            <tr>
                <th>Date</th>
                <th>Présence</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presences as $presence)
            <tr>
                <td>{{ $presence->date }}</td>
                <td>{{ $presence->presence }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Directrice: Asma Regaieg</p>
</body>
</html>
