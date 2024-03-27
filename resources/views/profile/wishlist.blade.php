@extends('layouts.home')
@section('title', 'Liste des utilisateurs')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h2>Vos favoris</h2>
        @if ($wishlist->count() === 0)
            <p>Votre wishlist est vide.</p>
        @else
            <div class="form-v fit-center">
                @foreach($wishlist as $offer)
                    <div class="container-1 area-bg liste-h">
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
