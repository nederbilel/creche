<!DOCTYPE html>
<html>
<head>
    <title>Liste des Enfants</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <h1>Liste des Enfants</h1>
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Date de Naissance</th>
                <th>Coordonnées de la Mère</th>
                <th>Coordonnées du Père</th>
                <th>Vaccin</th>
                <th>Adresse</th>
                <th>Maladie</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enfants as $enfant)
            <tr>
                <td class="text-center">
                    @if($enfant->picture_path)
                    <img src="{{ url('storage/' . $enfant->picture_path) }}" alt="Enfant's Picture">
                    @endif
                </td>
                <td>{{ $enfant->nom }}</td>
                <td>{{ $enfant->date_de_naissance }}</td>
                <td>{{ $enfant->nom_mere }} {{ $enfant->telephone1 }}</td>
                <td>{{ $enfant->nom_pere }} {{ $enfant->telephone2 }}</td>
                <td>{{ $enfant->vaccin }}</td>
                <td>{{ $enfant->adresse }}</td>
                <td>{{ $enfant->maladie }}</td>
                <td>{{ $enfant->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
