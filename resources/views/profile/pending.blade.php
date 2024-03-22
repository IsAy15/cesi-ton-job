<!-- resources/views/pending.blade.php -->
@extends('layouts.home')
@section('title', 'Utilisateurs en attente')

@section('content')
    <div class="container">
        <h1>Utilisateurs en attente</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Action</th>
                    <!-- Ajoutez d'autres colonnes si nécessaire -->
                </tr>
            </thead>
            <tbody>
                @foreach($pendingUsers as $user)
                <tr>
                    <td>{{ $user->lastname }} {{ $user->firstname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                    <form action="{{ route('profile.edit', $user->id) }}" method="GET">
    @csrf
    <!-- Vos champs de formulaire -->
    <button type="submit" class="btn btn-primary">Éditer</button>
</form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
