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
            <div>
                <label for="level">Niveau :</label>
                <select id="level" name="level">
                    @foreach($levels as $level)
                        <option value="{{ $level->title }}">{{ $level->title }}</option>
                    @endforeach
                </select>
            </div>
            <div id="additional-levels"></div>
            <button type="button" class="btn-1" onclick="addLevelSelector()">Plus</button>
            <button type="submit" class="btn-1">S'inscrire</button>
        </form>
    </div>
    
    <script>
        function addLevelSelector() {
            var levelSelector = document.createElement("select");
            levelSelector.name = "additional_levels[]";
            levelSelector.innerHTML = '<option value="" disabled selected hidden>Niveau</option>';
            @foreach($levels as $level)
                levelSelector.innerHTML += '<option value="{{ $level->title }}">{{ $level->title }}</option>';
            @endforeach
            document.getElementById("additional-levels").appendChild(levelSelector);
        }
    </script>
@endsection
