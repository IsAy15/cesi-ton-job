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

    <div class="container-1 default-bg fit-center">
        <h1>Connexion</h1>
        <form action="{{ route('auth.login') }}" method="post" class="form-v">
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
                <div class="mdp-options">
                    <label class="rememberme"><input type="checkbox" name="remember" id="remember" /> Se souvenir de moi</label>
                    <a href="#">Mot de passe oublié ?</a>
                </div>
            <button type="submit" class="btn-1">Se connecter</button>
        </form>
    </div>
    <div class="container-1 default-bg fit-center">
        <a href="{{ route('auth.register') }}" class="btn-1">Pas encore inscrit ?</a>
        <a href="#" class="btn-1">Je n'arrive pas à me connecter</a>
    </div>

    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
@endsection