@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/profile.css')
    <div class="c-1">
        <div id="infos_perso" class="bandeau-1">
            <div id="photo" class="c-2">
                <img src="{{ asset('images/icons/33645487-icC3B4ne-de-profil-avatar-portrait-masculin-personne-dC3A9contractC3A9e.png') }}" />
            </div>
            <div id="infos" class="infos">
                    <p>{{ Auth::user()->lastname }}</p>
                    <p>{{ Auth::user()->firstname }}</p>
                    <p>{{ Auth::user()->email }}</p>
                @if(Auth::user()->role=='user')
                    @foreach(Auth::user()->promotions as $promotion)
                        <p>{{ $promotion->name }}</p>
                    @endforeach
                @endif
            </div>
        </div>
        @if(Auth::user()->role=="admin")

        @else
            @if(Auth::user()->role=='user')
                <div id="admin" class="c-3">
                    <p>Compétences :</p>
                    <div class="liste"> <!-- A compléter -->
                        <div class="elements">
                            <p>Compétence 1</p>
                            <form class="delete"><a><i class="fa-regular fa-circle-xmark"></i></a></form>
                        </div>
                        <div class="elements">
                            <p>Compétence 2</p>
                            <form class="delete"><a><i class="fa-regular fa-circle-xmark"></i></a></form>
                        </div>
                        <div class="elements">
                            <p>Compétence 3</p>
                            <form class="delete"><a><i class="fa-regular fa-circle-xmark"></i></a></form>
                        </div>
                        <div class="elements">
                            <p>Compétence 4</p>
                            <form class="delete"><a><i class="fa-regular fa-circle-xmark"></i></a></form>
                        </div>
                        <div class="elements">
                            <p>Compétence 4</p>
                            <form class="delete"><a><i class="fa-regular fa-circle-xmark"></i></a></form>
                        </div>
                    <a href="#" class="btn-1 btn-2">+</a>
                    </div>
                </div>
            @endif
            @if(Auth::user()->role=="pilote")
                <div id="admin" class="c-3">
                    <p>Promotions :</p>
                    <div class="liste"> <!-- A compléter -->
                        <div class="elements">
                            <a href="#">Promo 1</a>
                        </div>
                        <div class="elements">
                            <a href="#">Promo 2</a>
                        </div>
                        <div class="elements">
                            <a href="#">Promo 3</a>
                        </div>
                        <div class="elements">
                            <a href="#">Promo 4</a>
                        </div>
                        <div class="elements">
                            <a href="#">Promo 5</a>
                        </div>
                    <a href="#" class="btn-1 btn-2">+</a>
                    </div>
                </div>
            @endif
        @endif
        @if(Auth::user()->role=="admin")
            <div class="interaction">
                <a href="#" class="btn-1">Voir les utilisateurs</a>
                <a href="#" class="btn-1">Voir les pilotes</a>
                <a href="#" class="btn-1">Voir les offres publiée(s)</a>
                <a href="#" class="btn-1">Voir les entreprises</a>
            </div>
        @else
            @if(Auth::user()->role=="user")
                <div class="interaction">
                    <a href="{{ route('profile.offers') }}" class="btn btn-primary">Voir les offres postulées</a>
                    <a href="#" class="btn btn-primary">voir les stats</a>
                </div>
            @endif
            @if(Auth::user()->role=="pilote")
                <div class="interaction">
                    <a href="#" class="btn btn-primary">Voir les offres publiée(s)</a>
                    <a href="#" class="btn btn-primary">Voir les entreprises</a>
                </div>
            @endif
        @endif
    </div>
@endsection