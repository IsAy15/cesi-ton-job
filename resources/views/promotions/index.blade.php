@extends('layouts.home')
@section('title', 'Liste des promotions')
@section('content')
@vite('resources/css/promotions.css')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1">
        <h1>Liste des promotions</h1>
        <a href="{{ route('promotions.create') }}" class="btn-1">Ajouter une promotion</a>
        <table class="">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Action</th>
                    <th>Utilisateurs</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promotion)
                    <tr>
                        <td>{{ $promotion->name }}</td>
                        <td>
                            <a href="{{ route('promotions.edit', $promotion->id) }}">Modifier</a>
                            <form action="{{ route('promotions.destroy', $promotion->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('promotions.users', $promotion->id) }}">Voir les utilisateurs</a> <!-- Lien vers la liste des utilisateurs de la promotion -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection