@extends('layouts.home')
@section('title', 'S\'inscrire')
@section('content')
    <div class="container">
        <h1 class="mt-5">S'inscrire</h1>
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('auth.register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="role">Rôle</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="pilote">Pilote</option>
                        <option value="user">User</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
@endsection
