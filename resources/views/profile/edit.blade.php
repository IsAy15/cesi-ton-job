@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/profile.css')
    <div class="container-1 default-bg fit-center">
        <h1>Modifier l'utilisateur</h1>
        <form action="{{ route('profile.update', $user->id) }}" method="POST" class="form-v">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Statut:</label>
                <select name="status" class="form-control">
                    <option value="approved" {{ $user->status === 'approved' ? 'selected' : '' }}>Approuvé</option>
                    <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>En attente</option>
                </select>
            </div>

            <button type="submit" class="btn-1">Enregistrer</button>
        </form>
    </div>
@endsection
