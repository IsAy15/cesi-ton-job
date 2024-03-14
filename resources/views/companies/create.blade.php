<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une entreprise</title>
</head>
<body>
    <h1>Ajouter une entreprise</h1>
    <form action="{{ route('companies.store') }}" method="post">
        @csrf
        <div>
            <label for="cp_name">Nom de l'entreprise</label>
            <input type="text" name="cp_name" id="cp_name">
        </div>
        <div>
            <label for="cp_sector">Secteur</label>
            <input type="text" name="cp_sector" id="cp_sector">
        </div>
        <div>
            <label for="cp_localization">Localisation</label>
            <input type="text" name="cp_localization" id="cp_localization">
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
