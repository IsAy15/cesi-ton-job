@extends('layouts.home')
@section('title', 'Utilisateurs de la promotion')
@section('content')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
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
    <a href="#" class="btn-1 btn-2"><i class="fa-solid fa-user-plus"></i></a>
    <a href="{{ route('promotions.index') }}" class="btn-1">Retour</a>
@endsection
