@extends('layouts.home')
@section('title', 'Liste des utilisateurs')
@section('content')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h2>Vos offres</h2>
        <div class="liste-v">
            @if ($wishlist->count() === 0)
                <p>Votre wishlist est vide.</p>
            @else
                <ul>
                    @foreach($wishlist as $offer)
                        <li>
                            <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                            @auth
                            <form action="{{ route('wishlist.remove', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer de la wishlist</button>
                        </form>

                            @endauth
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
