<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création des offres</title>
</head>
<body>
    <h1>Ajouter une offre</h1>
    <form action="{{ route('offers.store') }}" method="post">
        @csrf
        <div>
            <label for="of_title">Titre</label>
            <input type="text" name="of_title" id="of_title">
        </div>
        <div>
            <label for="of_description">Description</label>
            <input type="text" name="of_description" id="of_description">
        </div>
        <div>
            <label for="of_localization">Localisation</label>
            <input type="text" name="of_localization" id="of_localization">
        </div>
        <div>
            <label for="of_starting_date">Date de début</label>
            <input type="date" name="of_starting_date" id="of_starting_date">
        </div>
        <div>
            <label for="of_ending_date">Date de fin</label>
            <input type="date" name="of_ending_date" id="of_ending_date">
        </div>
        <div>
            <label for="of_places">Places disponibles</label>
            <input type="number" name="of_places" id="of_places">
        </div>
        <div>
            <label for="of_salary">Salaire</label>
            <input type="number" name="of_salary" id="of_salary">
        </div>
        <div>
            <label for="of_type">Type</label>
            <input type="text" name="of_type" id="of_type">
        </div>
        <div>
            <label for="of_company_id">ID de l'entreprise</label>
            <input type="number" name="of_company_id" id="of_company_id">
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
