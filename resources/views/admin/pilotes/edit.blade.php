<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->lastname }} {{ $user->firstname }}</title>
</head>
<body>
    <form action="{{ route('admin.pilotes.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="user_lastname">Nom</label>
            <input type="text" name="user_lastname" id="user_lastname" value="{{ $user->lastname }}">
        </div>
        <div>
            <label for="user_firstname">Prénom</label>
            <input type="text" name="user_firstname" id="user_firstname" value="{{ $user->firstname }}">
        </div>
        <div>
            <label for="user_email">Email</label>
            <input type="email" name="user_email" id="user_email" value="{{ $user->email }}">
        </div>
        <div>
            <label for="user_role">Rôle</label>
            <input type="text" name="user_role" id="user_role" value="{{ $user->role }}">
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>