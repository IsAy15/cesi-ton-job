<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des entreprises</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .company {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .company .infos {
            margin-bottom: 10px;
        }
        .company .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Liste des Entreprises</h1>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Ajouter une entreprise</a> <!-- Utilisation d'un bouton Bootstrap -->
    @foreach ($companies as $company)
        <div class="company">
            <div class="infos">
                <h2>{{ $company->name }}</h2>
                <p>Secteur : {{ $company->sector }}</p>
                <p>Localisation : {{ $company->localization }}</p>
                <p>Moyenne des notes : {{ $company->average_grade }}</p> <!-- Affichage de la moyenne des notes -->
            </div>
            <div class="actions">
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Modifier</a> <!-- Utilisation d'un bouton Bootstrap -->
                <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button> <!-- Utilisation d'un bouton Bootstrap -->
                </form>
            </div>
        </div>
    @endforeach
</body>
</html>
