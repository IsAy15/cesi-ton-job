@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/profile.css')
<div class="container-1 default-bg fit-center">
    <div id="infos_perso" class="liste-h">
        <div id="photo" class="container-rond">
            <img src="{{ asset('images/icons/33645487-icC3B4ne-de-profil-avatar-portrait-masculin-personne-dC3A9contractC3A9e.png') }}" />
        </div>
        <div id="infos" class="liste-v">
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
            <div id="admin" class="container-1 area-bg">
                <p>Compétences :</p>
                <div class="liste-h"> 
                    @foreach($abilities as $ability)
                        <div class="liste-h elements">
                            <p>{{ $ability->title }}</p>
                            <form class="delete"><a><i class="fa-regular fa-circle-xmark"></i></a></form>
                        </div>
                    @endforeach
                    <a href="{{ route('profile.add') }}" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        @endif
        @if(Auth::user()->role=="pilote")
            <div id="admin" class="container-1 area-bg">
                <p>Promotions :</p>
                <div class="liste-h"> 
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
        <div class="liste-h">
            <a href="{{ route('users.index') }}" class="btn-1">Voir les utilisateurs</a>
            <a href="{{ route('promotions.index') }}" class="btn-1">Voir les promotions</a>
            <a href="{{ route('offers.index') }}" class="btn-1">Voir les offres publiée(s)</a>
            <a href="{{ route('companies.index') }}" class="btn-1">Voir les entreprises</a>
            <a href="{{route('profile.pending')}}" class="btn-1">Voir les utilisateurs en attente</a>
        </div>
    @else
        @if(Auth::user()->role=="user")
            <div class="liste-h">
                <a href="{{ route('profile.offers') }}" class="btn-1 btn-2">Voir les offres postulées</a>
                <a href="#" class="btn-1 btn-2">voir les stats</a>
            </div>
        @endif
        @if(Auth::user()->role=="pilote")
            <div class="liste-h">
                <a href="{{ route('offers.index') }}" class="btn-1 btn-2">Voir les offres publiées</a>
                <a href="{{ route('companies.index') }}" class="btn-1 btn-2">Voir les entreprises</a>
            </div>
        @endif
    @endif
</div>
@endsection
