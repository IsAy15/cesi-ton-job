@extends('layouts.home')
@section('title', 'Ajouter un utilisateur')
@section('content')
    <div class="container-1 default-bg ">
        <h1>Créer un utilisateur</h1>
        <form action="{{ route('users.store') }}" method="post" class="form-v" id="user-form">
            @csrf
            <div class="input-required">
                <input type="text" id="lastname" name="lastname" placeholder="Nom">
            </div>
            <div class="input-required">
                <input type="text" id="firstname" name="firstname" placeholder="Prénom">
            </div>
            <div class="input-required">
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="input-required">
                <input type="password" id="password" name="password" placeholder="Mot de passe">
            </div>
            <div>
                <select name="role" id="role">
                    @foreach($roles as $key => $role)
                        <option value="{{ $key }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-required">
                <select id="promotion" name="promotion">
                    <option value="" disabled selected>Promotion</option>
                    @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="levels-container" class="input-required fit-center">
                <label>Niveau : </label>
                <div class="abilities-select area-bg">
                    @foreach($levels as $level)
                    <label>
                        <input type="checkbox" name="levels[]" value="{{ $level->id }}">
                        {{ $level->title }}
                    </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn-1">Créer</button>
        </form>
    </div>
@vite('resources/js/users/champ_obligatoire.js')
@endsection