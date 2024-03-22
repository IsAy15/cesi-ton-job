@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/profile.css')
@vite('resources/css/brouillon-generale.css')
    <div class="container">
        <h1>Modifier l'utilisateur</h1>
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Champ pour modifier le statut de l'utilisateur -->
            <div class="form-group">
                <label for="status">Statut:</label>
                <select name="status" class="form-control">
                    <option value="approved" {{ $user->status === 'approved' ? 'selected' : '' }}>Approuvé</option>
                    <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>En attente</option>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection
