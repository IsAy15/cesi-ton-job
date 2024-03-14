@extends('layouts.home')
@section('content')
    <h1>Utilisateurs</h1>
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
@endsection