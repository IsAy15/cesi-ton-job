@extends('layouts.home')
@section('title', 'Se connecter')
@section('content')
    <div class="container connexion">
        <h1>Connexion</h1>
        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
