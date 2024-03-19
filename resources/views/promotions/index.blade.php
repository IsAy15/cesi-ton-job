@extends('layouts.home')
@section('title', 'Liste des promotions')
@section('content')
    <h1>Liste des promotions</h1>
    <a href="{{ route('promotions.create') }}">Ajouter une promotion</a>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Action</th>
                <th>Utilisateurs</th> <!-- Nouvelle colonne pour les utilisateurs -->
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
@endsection