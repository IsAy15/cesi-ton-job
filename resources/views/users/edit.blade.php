@extends('layouts.home')
@section('title', 'Modifier un utilisateur')
@section('content')
@vite('resources/css/offer.css')
<div class="container-1 default-bg fit-center">
    <h1>Modifier l'utilisateur</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="input-required fit-center">
            <label for="lastname">Nom</label>
            <input id="lastname" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}">
        </div>

        <div class="input-required fit-center">
            <label for="firstname">Prénom</label>
            <input id="firstname" type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}">
        </div>

        <div class="input-required fit-center">
            <label for="email">Adresse email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <div class="input-required fit-center">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" value="{{ old('email', $user->password) }}">
        </div>

        @if($user->role !== 'admin')
        <div class="input-required fit-center">
            <label for="role">Rôle</label>
            <select id="role" name="role">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pilote" {{ $user->role === 'pilote' ? 'selected' : '' }}>Pilote</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="input-required fit-center">
            <label for="promotion">Promotion</label>
            <select id="promotion" name="promotion">
                @foreach($promotions as $promotion)
                <option value="{{ $promotion->id }}" {{ $user->promotions->contains($promotion->id) ? 'selected' : '' }}>{{ $promotion->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="fit-center">
            <!-- Ajouter un champ caché pour envoyer le rôle actuel -->
            <button type="submit" class="btn-1">Modifier</button>
        </div>
    </form>
</div>
@endsection
