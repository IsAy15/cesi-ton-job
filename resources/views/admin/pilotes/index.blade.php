<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
</head>
<body>
    <h1>Utilisateurs</h1>
    @auth
        <p>Connecté en tant que : {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    @endauth
    @guest
        <a href="{{ route('auth.login') }}">Se connecter</a> 
    @endguest
    <a href="{{ route('admin.pilotes.create') }}">Ajouter un utilisateur</a>
    @foreach ($users as $user)
        <div class="user">
            <div class="infos">
                <h2>{{ $user->lastname }} {{ $user->firstname }}</h2>
                <p>{{ $user->email }}</p>
                <p>{{ $user->role }}</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.pilotes.edit', $user->id) }}">Modifier</a>
                <form action="{{ route('admin.pilotes.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
</body>
</html>
