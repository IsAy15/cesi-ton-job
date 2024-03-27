@extends('layouts.home')
@section('title', 'Ajouter un utilisateur')
@section('content')
    <div class="container-1 default-bg ">
        <h1>Créer un utilisateur</h1>
        <form action="{{ route('users.store') }}" method="post" class="form-v">
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
                <select id="role" name="role">
                    <option value="user" disabled selected>Rôle</option>
                    <option value="admin">Admin</option>
                    <option value="users">User</option>
                    <option value="pilote">Pilote</option>
                </select>
            </div>
            <div class="input-required">
                <input type="password" id="password" name="password" placeholder="Mot de passe">
            </div>
            <div class="input-required">
                <select id="promotion" name="promotion" style="display:none;">
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
            var roleSelect = document.getElementById('role');
            var promotionLabel = document.getElementById('promotionLabel');
            var promotionSelect = document.getElementById('promotion');

            roleSelect.addEventListener('change', function() {
                if (roleSelect.value === 'admin') {
                    promotionSelect.style.display = 'none';
                } else {
                    promotionSelect.style.display = 'block';
                }
            });
        };
    </script>
@endsection
