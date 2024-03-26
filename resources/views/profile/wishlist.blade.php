@extends('layouts.home')
@section('title', 'Liste des utilisateurs')
@section('content')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h2>Vos offres</h2>
        @if ($wishlist->count() === 0)
            <p>Votre wishlist est vide.</p>
        @else
            <div class="form-v">
                @foreach($wishlist as $offer)
                    <div class="c-1 bg-2 space">
                            <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                            @auth
                            <form action="{{ route('wishlist.remove', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-heart"></i></button>
                        </form>

                            @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
