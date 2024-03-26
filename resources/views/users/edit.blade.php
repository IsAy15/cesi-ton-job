@extends('layouts.home')
@section('title', 'Modifier un utilisateur')
@section('content')
@vite('resources/css/offres.css')
@vite('resources/css/brouillon-generale.css')
@if(Auth::user()->role == 'user')
    <?php
        header('Location: /access-denied.php');
        exit();
    ?>
@endif
<div class="c-1 bg-1 fit-center">
    <form action="{{ route('users.update', $user->id) }}" method="post" class="form-v">
        @csrf
        @method('PUT')
        <div class="input-required fit-center">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}">
        </div>
        <div class="input-required fit-center">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}">
        </div>
        <div class="input-required fit-center">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
        </div>
        <div class="input-required fit-center">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" value="{{ $user->password }}">
        </div>
        @if($user->role != 'admin')
        <div class="input-required fit-center">
            <label for="role">Rôle</label>
            <select name="role" id="role">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pilote" {{ $user->role == 'pilote' ? 'selected' : '' }}>Pilote</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="input-required fit-center">
            <label for="promotion">Promotion</label>
            <select name="promotion" id="promotion">
                @foreach($promotions as $promotion)
                    <option value="{{ $promotion->id }}" {{ $user->promotions->contains($promotion->id) ? 'selected' : '' }}>
                        {{ $promotion->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
        <button type="submit" class="btn-1">Modifier</button>
    </form>
</div>
@endsection
