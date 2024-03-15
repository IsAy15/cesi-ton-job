<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
</head>
<body>
    <form action="{{ route('offers.update', $offer->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="of_title">Titre</label>
            <input type="text" name="of_title" id="of_title" value="{{ $offer->title }}">
        </div>
        <div>
            <label for="of_description">Description</label>
            <input type="text" name="of_description" id="of_description" value="{{ $offer->description }}">
        </div>
        <div>
            <label for="of_localization">Localisation</label>
            <input type="text" name="of_localization" id="of_localization" value="{{ $offer->localization }}">
        </div>
        <div>
            <label for="of_starting_date">Date de début</label>
            <input type="date" name="of_starting_date" id="of_starting_date" value="{{ $offer->starting_date }}">
        </div>
        <div>
            <label for="of_ending_date">Date de fin</label>
            <input type="date" name="of_ending_date" id="of_ending_date" value="{{ $offer->ending_date }}">
        </div>
        <div>
            <label for="of_places">Places disponibles</label>
            <input type="number" name="of_places" id="of_places" value="{{ $offer->places }}">
        </div>
        <div>
            <label for="of_salary">Salaire</label>
            <input type="number" name="of_salary" id="of_salary" value="{{ $offer->salary }}">
        </div>
        <div>
            <label for="of_type">Type</label>
            <input type="text" name="of_type" id="of_type" value="{{ $offer->type }}">
        </div>
        <div>
            <label for="of_company_id">Nom de l'entreprise</label>
            <select name="of_company_id" id="of_company_id">
                @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
