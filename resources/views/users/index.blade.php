@extends('layouts.home')
@section('title', 'Liste des utilisateurs')
@section('content')
    <?php
        if (Auth::check() && strpos(Auth::user()->role, 'user') !== false) {
            header('Location: /access-denied.php'); 
            exit();
        }
    ?>
    <h1>Liste des utilisateurs</h1>
   
    @guest
        <a href="{{ route('auth.login') }}">Se connecter</a> 
    @endguest

    <input type="text" id="searchInput" placeholder="Rechercher un utilisateur...">
    
    <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>

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
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}">Modifier</a>
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
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}">Modifier</a>
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
@endsection
