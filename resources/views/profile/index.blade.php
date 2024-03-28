@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
<div class="container-1 default-bg fit-center">
    <div id="infos_perso" class="liste-h">
        <div id="photo" class="container-rond">
            <img src="{{ asset('images/icons/33645487-icC3B4ne-de-profil-avatar-portrait-masculin-personne-dC3A9contractC3A9e.png') }}" />
        </div>
        <div id="infos" class="liste-v">
            <p>{{ $user->lastname }}</p>
            <p>{{ $user->firstname }}</p>
            <p>{{ $user->email }}</p>
            @if($user->role=='user')
                @foreach($user->promotions as $promotion)
                    <p>{{ $promotion->name }}</p>
                @endforeach
            @endif
        </div>
    </div>
    @if($user->role=="admin")
    @else
        @if($user->role=='user')
            <div id="admin" class="container-1 area-bg">
                <p>Compétences :</p>
                <div class="liste-h"> 
                    @forelse($user->abilities as $ability)
                        <div class="liste-h elements">
                            <p>{{ $ability->title }}</p>
                            <form action="{{ route('profile.destroy', $ability->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-1 btn-2"><i class="fa-regular fa-circle-xmark"></i></button>
                            </form>
                        </div>
                    @empty
                        <p>Aucune compétence</p>
                    @endforelse
                    @if(!$allabilities->isEmpty())
                        <div class="popup" style="display: none;">
                            <div class="popup-content" id="popup-content">
                                <form action="{{ route('profile.store') }}" method="POST">
                                    @csrf
                                    <select name="abilities[]" multiple>
                                        @foreach($allabilities as $ability)
                                            <option value="{{ $ability->id }}">{{ $ability->title }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-check"></i></button>
                                </form>
                            </div>
                        </div>
                        <button id="btn-plus" type="button" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></button>
                    @endif
                </div>
            </div>
        @endif
        @if($user->role=="pilote")
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
    @if($user->role=="admin")
        <div class="liste-h">
            <a href="{{ route('users.index') }}" class="btn-1">Voir les utilisateurs</a>
            <a href="{{ route('promotions.index') }}" class="btn-1">Voir les promotions</a>
            <a href="{{ route('offers.index') }}" class="btn-1">Voir les offres publiée(s)</a>
            <a href="{{ route('companies.index') }}" class="btn-1">Voir les entreprises</a>
            <a href="{{ route('profile.pending') }}" class="btn-1">Voir les utilisateurs en attente</a>
        </div>
    @else
        @if($user->role=="user")
            <div class="liste-h">
                <a href="{{ route('profile.offers') }}" class="btn-1 btn-2">Voir les offres postulées</a>
                <a href="#" class="btn-1 btn-2">voir les stats</a>
            </div>
        @endif
        @if($user->role=="pilote")
            <div class="liste-h">
                <a href="{{ route('offers.index') }}" class="btn-1 btn-2">Voir les offres publiées</a>
                <a href="{{ route('companies.index') }}" class="btn-1 btn-2">Voir les entreprises</a>
                <a href="{{ route('profile.pending') }}" class="btn-1">Voir les utilisateurs en attente</a>
            </div>
        @endif
    @endif
</div>
@vite('resources/js/promotion_ability.js')
@endsection
