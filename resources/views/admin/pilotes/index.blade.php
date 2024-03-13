@extends('layouts.home')
@section('content')
    <h1>Utilisateurs</h1>
        <a href="{{ route('admin.pilotes.create') }}">Ajouter un utilisateur</a>
        @foreach ($users as $user)
            <div class="user">
                <div class="infos">
                <h2>{{ $user->user_lastname }} {{ $user->user_firstname }}</h2>
                <p>{{ $user->user_email }}</p>
                <p>{{ $user->user_role }}</p>
                </div>
                <div class="actions">
                    <a href="{{ route('admin.pilotes.edit', $user->user_id) }}">Modifier</a>
                    <form action="{{ route('admin.pilotes.destroy', $user->user_id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
@endsection