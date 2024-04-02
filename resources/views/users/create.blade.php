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
            <select id="level" name="level">
                <option value="" disabled selected>Niveau</option>
                @foreach($levels as $level)
                    <option value="{{ $level->title }}">{{ $level->title }}</option>
                @endforeach
            </select>
            <div class="input-required">
                <select id="promotion" name="promotion">
                    <option value="" disabled selected>Promotion</option>
                    @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-1">Créer</button>
        </form>
    </div>
    <script>
        window.onload = function() {
            document.getElementById('role').addEventListener('change', function() {
                if (this.value === 'admin') {
                    document.getElementById('promotion').style.display = 'none';
                    document.getElementById('level').style.display = 'none';
                } else {
                    document.getElementById('promotion').style.display = 'block';
                    document.getElementById('level').style.display = 'block';
                }
            });

            document.getElementById('password').addEventListener('input', function() {
                if (this.value.length < 6) {
                    this.setCustomValidity('Le mot de passe doit contenir au moins 6 caractères');
                } else {
                    this.setCustomValidity('');
                }
            });

            document.getElementById('user-form').addEventListener('submit', function(event) {
                var inputs = document.querySelectorAll('.input-required input, .input-required select');
                var isEmpty = false;
                var isInvalidOption = false;

                inputs.forEach(function(input) {
                    if (input.value.trim() === '') {
                        isEmpty = true;
                        input.classList.add('error');
                    } else {
                        input.classList.remove('error');
                    }
                    if (input.tagName === 'SELECT' && input.value === '') {
                        isInvalidOption = true;
                    }
                });

                if (isEmpty && isInvalidOption) {
                    event.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires et sélectionner une option valide.');
                } else if (isEmpty) {
                    event.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                } else if (isInvalidOption) {
                    event.preventDefault();
                    alert('Veuillez sélectionner une option valide.');
                }
            });
        };
    </script>
@endsection
