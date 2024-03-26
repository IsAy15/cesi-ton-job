@extends('layouts.home')
@section('title', 'Modifier un utilisateur')
@section('content')
@vite('resources/css/offres-brouillon.css')
@vite('resources/css/brouillon-generale.css')
@if(Auth::check() && strpos(Auth::user()->role, 'user') !== false)
    <?php
        header('Location: /access-denied.php'); 
        exit();
    ?>
@endif
<div class="container">
    <h1>Modifier un utilisateur</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="lastname">Nom :</label>
            <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="firstname">Prénom :</label>
            <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Rôle :</label>
            <select name="role" id="role" class="form-control" >
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pilote" {{ $user->role == 'pilote' ? 'selected' : '' }}>Pilote</option>
                <option value="utilisateur" {{ $user->role == 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}">
        </div>
        @if(Auth::user()->role = 'admin') 
        <div class="form-group">
            <label for="promotion">Promotion :</label>
            <select name="promotion" id="promotion" class="form-control">
                @foreach($promotions as $promotion)
                    <option value="{{ $promotion->id }}" {{ $user->promotions->contains($promotion) ? ($selected = true) ? 'selected' : 'selected' : '' }}>
                        {{ $promotion->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
