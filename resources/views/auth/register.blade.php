@extends('layouts.home')
@section('title', 'S\'inscrire')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Formulaire d'inscription</h1>
        <form action="{{ route('auth.register') }}" method="post" class="form-v">
            @csrf
            <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="Prénom">
            <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Nom">
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <div>
                <label for="role">Rôle :</label>
                <select id="role" name="role">
                    <option value="pilote">Pilote</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div>
                <label for="promotion">Promotion :</label>
                <select id="promotion" name="promotion">
                    @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="fit-center form-v">
                <label>Niveau : </label>
                <div class="abilities-select area-bg">
                    @foreach($levels as $level)
                        <label>
                            <input type="{{ auth()->user() && auth()->user()->role == 'user' ? 'radio' : 'checkbox' }}" name="levels[]" value="{{ $level->id }}">
                            {{ $level->title }}
                        </label>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn-1">S'inscrire</button>
        </form>
    </div>
@vite('resources/js/auth/champ_obligatoire.js')

@endsection