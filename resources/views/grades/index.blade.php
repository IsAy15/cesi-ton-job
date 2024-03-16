<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des notes</title>
</head>
<body>
    <h1>Liste des notes</h1>
    <a href="{{ route('grades.create') }}">Ajouter une note</a>
    <table>
        <thead>
            <tr>
                <th>Valeur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->value }}</td>
                    <td>
                        <a href="">Modifier</a>
                        <form action="" method="post">
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
