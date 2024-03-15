<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les offres</title>
</head>
<body>
    <h1>Offres d'emploi</h1>
    <a href="{{ route('offers.create') }}">Ajouter une offre</a>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Localisation</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Places disponibles</th>
                <th>Salaire</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
                <tr>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->description }}</td>
                    <td>{{ $offer->localization }}</td>
                    <td>{{ $offer->starting_date }}</td>
                    <td>{{ $offer->ending_date }}</td>
                    <td>{{ $offer->places }}</td>
                    <td>{{ $offer->salary }}</td>
                    <td>{{ $offer->type }}</td>
                    <td>
                        <a href="{{ route('offers.edit', $offer->id) }}">Modifier</a>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>