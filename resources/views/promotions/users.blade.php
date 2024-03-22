@extends('layouts.home')
@section('title', 'Utilisateurs de la promotion')
@section('content')
    @vite('resources/css/brouillon-generale.css')

    <link rel="stylesheet" href="{{ asset('resources/css/brouillon-generale.css') }}">
    <div class="c-1 bg-1 fit-center">
        <h1>Utilisateurs de la promotion "{{ $promotion->name }}"</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($users->sortByDesc(function ($user) {
                    return $user->role === 'pilote';
                }) as $user)
                    <tr>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->email }}</td>
                        <td> 
                            <form class='form-v' action="{{ route('promotions.removeUser', [$user->id, $promotion->id]) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur de la promotion?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('promotions.addUser', $promotion->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-user-plus"></i></a>
        <a href="{{ route('promotions.index') }}" class="btn-1">Retour</a>
    </div>
@endsection
