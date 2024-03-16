<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des entreprises</title>
</head>
<body>
    <h1>Liste des Entreprises</h1>
    <a href="{{ route('companies.create') }}">Ajouter une entreprise</a>
    @foreach ($companies as $company)
        <div class="company">
            <div class="infos">
                <h2>{{ $company->name }}</h2>
                <p>Secteur : {{ $company->sector }}</p>
                <p>Localisation : {{ $company->localization }}</p>
                <p>Moyenne des notes : {{ $company->average_grade }}</p> <!-- Affichage de la moyenne des notes -->
            </div>
            <div class="actions">
                <a href="{{ route('companies.edit', $company->id) }}">Modifier</a>
                <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
</body>
</html>
