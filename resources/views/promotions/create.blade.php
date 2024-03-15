<!-- create.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter une promotion</h1>
    <form action="{{ route('promotions.store') }}" method="post">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name">
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
