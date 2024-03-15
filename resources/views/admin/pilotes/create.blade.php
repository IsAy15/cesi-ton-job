<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
    <form action="{{ route('admin.pilotes.store') }}" method="post">
        @csrf
        <div>
            <label for="user_lastname">Nom</label>
            <input type="text" name="user_lastname" id="user_lastname">
        </div>
        <div>
            <label for="user_firstname">Prénom</label>
            <input type="text" name="user_firstname" id="user_firstname">
        </div>
        <div>
            <label for="user_email">Email</label>
            <input type="email" name="user_email" id="user_email">
        </div>
        <div>
            <label for="user_role">Rôle</label>
            <input type="text" name="user_role" id="user_role">
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>