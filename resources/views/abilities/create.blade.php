<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de nouvelles compétences</title>
</head>
<body>
    <h1>Ajouter une compétence</h1>
    <form action="{{ route('abilities.store') }}" method="post">
        @csrf
        <div>
            <label for="ab_title">Titre</label>
            <input type="text" name="ab_title" id="ab_title">
        </div>
        <div>
            <label for="ab_description">Description</label>
            <input type="text" name="ab_description" id="ab_description">
        </div>
        <button type="submit">Ajouter</button>
</body>
</html>