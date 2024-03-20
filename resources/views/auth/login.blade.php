@extends('layouts.home')
@section('title', 'Se connecter')
@section('content')
@vite('resources/css/login.css')
<?php
    if (Auth::check()) {
        header('Location: ' . route('profile.index')); 
        exit();
    }
?>

    <div class="c-1 bg-1 connexion">
        <h1>Connexion</h1>
        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            <div class="input-required">
                <input type="email" name="email" id="email" placeholder="Email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-required">
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                <div class="mdp">
                    <a href="#" onclick="alert('Alors connard ?\nTu as oublié ton mot de passe ?');">Mot de passe oublié ?</a>
                </div>
            <button type="submit" class="btn-1">Se connecter</button>
        </form>
    </div>
    <div class="c-1 bg-1 connexion">
        <a href="{{ route('auth.register') }}" class="btn-1">Pas encore inscrit ?</a>
        <a href="#" class="btn-1"onclick="alert('Alors connard ?\nTu es nul ?');">Je n'arrive pas à me connecter</a>
    </div>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
@endsection