<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>
    <?php
        // Vérifie si l'utilisateur est authentifié et s'il a le rôle "user"
        if (Auth::check() && Auth::user()->role == 'user') {
            // Redirige vers une page d'accès refusé ou une autre page appropriée
            header('Location: /access-denied.php'); // Remplacez '/access-denied.php' par le chemin de la page d'accès refusé
            exit();
        }
    ?>
    
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

    <!-- Barre de recherche -->
    <input type="text" id="searchInput" placeholder="Rechercher un utilisateur...">
    
    <!-- Bouton "Ajouter un utilisateur" -->
    <a href="{{ route('users.create') }}">Ajouter un utilisateur</a>

    <table id="userTable">
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
                @if(Auth::user()->role == 'pilote' && $user->role == 'user')
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
                @elseif(Auth::user()->role != 'pilote')
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
                @endif
            @endforeach
        </tbody>
    </table>

    <script>
        function filterUsers() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                if (td1 || td2) {
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }

        // Appeler la fonction de filtrage lorsque l'utilisateur tape quelque chose dans la barre de recherche
        document.getElementById("searchInput").addEventListener("keyup", filterUsers);
    </script>
</body>
</html>

