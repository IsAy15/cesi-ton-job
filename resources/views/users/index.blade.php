<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
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

    <!-- Bouton "Ajouter un utilisateur" -->
    <a href="{{ route('users.create') }}">Ajouter un utilisateur</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Promotions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usersWithPromotions as $user)
            <tr>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->promotions as $promotion)
                        <a href="{{ route('promotions.users', ['id' => $promotion->id]) }}">{{ $promotion->name }}</a> 
                        @if(!$loop->last)
                            , 
                        @endif
                    @endforeach
                </td>
                <td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
