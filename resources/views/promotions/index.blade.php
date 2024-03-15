<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des différentes promotions</title>
</head>
<body>
    <h1>Liste des promotions</h1>
        <a href="{{ route('promotions.create') }}">Ajouter une promotion</a>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promotion)
                    <tr>
                        <td>{{ $promotion->name }}</td>
                        <td>
                            <a href="{{ route('promotions.edit', $promotion->id) }}">Modifier</a>
                            <form action="{{ route('promotions.destroy', $promotion->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
</body>
</html>