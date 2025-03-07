@extends('layouts.home')
@section('title', 'Liste des utilisateurs')
@section('content')

    <div class="container-1 default-bg fit-center">
        <h1>Liste des utilisateurs</h1>
        <input type="text" id="searchInput" placeholder="Rechercher un utilisateur...">
        <a href="{{ route('users.create') }}" class="btn-1">Ajouter un utilisateur</a>
        <a href="{{ route('profile.pending') }}" class="btn-1">Voir les utilisateurs en attente</a>
        <table id="userTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Campus</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usersCesi as $user)
                    <tr>
                        <td><a href="{{ route('users.show', ['id' => $user->id]) }}" class="clickable">{{ $user->lastname }}</a></td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->campus }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pilote')
                                <div class="table-interactions">
                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-1 btn-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
            
        </table>
        <div>
        {{ $usersCesi->links() }}
    </div>
        
    </div>


@vite('/resources/js/user_search.js')
@endsection
