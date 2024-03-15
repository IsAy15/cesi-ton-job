<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des compétences
    </title>
</head>
<body>
    <h1>Liste des compétences</h1>
        <a href="{{ route('abilities.create') }}">Ajouter une compétence</a>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abilities as $ability)
                    <tr>
                        <td>{{ $ability->title }}</td>
                        <td>{{ $ability->description }}</td>
                        <td>
                            <a href="{{ route('abilities.edit', $ability->id) }}">Modifier</a>
                            <form action="{{ route('abilities.destroy', $ability->id) }}" method="post">
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