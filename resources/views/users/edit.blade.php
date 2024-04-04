@extends('layouts.home')
@section('title', 'Modifier un utilisateur')
@section('content')
@vite('resources/css/offer.css')
<div class="container-1 default-bg fit-center">
    <h1>Modifier l'utilisateur</h1>
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="form-v">
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
            <input id="password" type="password" name="password" value="{{ old('password', $user->password) }}">
        </div>

        <div  class="input-required fit-center">
            <label for="campus">Campus</label>
            <select id="campus" name="campus">
            <option value="" disabled selected>Campus</option>
                    <option value="Aix-en-Provence">Aix-en-Provence</option>
                    <option value="Angoulême">Angoulême</option>
                    <option value="Arras">Arras</option>
                    <option value="Bordeaux">Bordeaux</option>
                    <option value="Brest">Brest</option>
                    <option value="Caen">Caen</option>
                    <option value="Dijon">Dijon</option>
                    <option value="Grenoble">Grenoble</option>
                    <option value="La Rochelle">La Rochelle</option>
                    <option value="Le Mans">Le Mans</option>
                    <option value="Lille">Lille</option>
                    <option value="Lyon">Lyon</option>
                    <option value="Montpellier">Montpellier</option>
                    <option value="Nancy">Nancy</option>
                    <option value="Nantes">Nantes</option>
                    <option value="Nice">Nice</option>
                    <option value="Orléans">Orléans</option>
                    <option value="Paris-La Défense">Paris-La Défense</option>
                    <option value="Paris-Nanterre">Paris-Nanterre</option>
                    <option value="Pau">Pau</option>
                    <option value="Reims">Reims</option>
                    <option value="Rouen">Rouen</option>
                    <option value="Saint-Nazaire">Saint-Nazaire</option>
                    <option value="Strasbourg">Strasbourg</option>
                    <option value="Toulouse">Toulouse</option>
                </select>
        @if($user->role !== 'admin')
        <div class="input-required fit-center">
            <label for="role">Rôle</label>
            <select id="role" name="role">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pilote" {{ $user->role === 'pilote' ? 'selected' : '' }}>Pilote</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
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

        <div class="input-required fit-center">
            <label for="level">Niveau</label>
            <div class="abilities-select area-bg">
                @foreach($levels as $level)
                    <label>
                        <input type="{{ $user->role === 'user' ? 'radio' : 'checkbox' }}" name="levels[]" value="{{ $level->id }}" {{ $user->userLevels->contains('level_id', $level->id) ? 'checked' : '' }}>
                        {{ $level->title }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="fit-center">
            <button type="submit" class="btn-1">Modifier</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('role');
        var levelCheckboxes = document.querySelectorAll('input[name="levels[]"]');
        
        roleSelect.addEventListener('change', function() {
            if (roleSelect.value === 'user') {
                levelCheckboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('click', function() {
                        // Désactiver tous les autres checkboxes
                        levelCheckboxes.forEach(function(otherCheckbox) {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.checked = false;
                            }
                        });
                    });
                });
            } else {
                levelCheckboxes.forEach(function(checkbox) {
                    checkbox.removeEventListener('click', null);
                });
            }
        });
    });
</script>
@endsection
