<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la promotion</title>
</head>
<body>
    <h1>Modifier la promotion</h1>
    <form action="{{ route('promotions.update', $promotion->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" value="{{ $promotion->name }}">
        </div>
        <button type="submit">Modifier</button>
</body>
</html>