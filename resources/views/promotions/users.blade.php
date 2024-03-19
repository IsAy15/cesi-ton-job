@extends('layouts.home')
@section('title', 'Utilisateurs de la promotion')
@section('content')
    <h1>Utilisateurs de la promotion "{{ $promotion->name }}"</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('promotions.index') }}">Retour</a>
@endsection
