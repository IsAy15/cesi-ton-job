@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/profile.css')
@vite('resources/css/abilities.css')
<div class="container-1 default-bg fit-center">
    <div id="infos_perso" class="liste-h">
        <div id="photo" class="container-rond">
            <img src="{{ asset('images/icons/33645487-icC3B4ne-de-profil-avatar-portrait-masculin-personne-dC3A9contractC3A9e.png') }}" />
        </div>
        <div id="infos" class="liste-v">
            <p>{{ $user->lastname }}</p>
            <p>{{ $user->firstname }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $title }}</p>
            @if($user->role=='user')
                <p>{{ $user->promotions[0]->name }}</p>
            @endif
        </div>
    </div>
    @switch($user->role)
        @case('admin')
        <div id="promotions" class="container-1 area-bg">
                <p>Mes promotions :</p>
                <div class="liste-h">
                    @forelse($user->promotions as $promotion)
                        <div class="elements">
                            <a href="{{ route('promotions.users', $promotion->id) }}">{{ $promotion->name }}</a>
                        </div>
                    @empty
                        <p>Aucune promotion</p>
                    @endforelse
                    <a href="#" class="btn-1 btn-2">+</a>
                </div>
            </div>
            <div class="liste-h">
                <a href="{{ route('users.index') }}" class="btn-1">Voir les utilisateurs</a>
                <a href="{{ route('promotions.index') }}" class="btn-1">Voir les promotions</a>
                <a href="{{ route('offers.index') }}" class="btn-1">Voir les offres publiée(s)</a>
                <a href="{{ route('companies.index') }}" class="btn-1">Voir les entreprises</a>
                <a href="{{ route('profile.pending') }}" class="btn-1">Voir les utilisateurs en attente</a>
            </div>
            @break
        @case('user')
            <div class="container-1 area-bg">
                <p>Compétences :</p>
                <div class="liste-h ability_container">
                    <div class="container">
                        <input id="searchInput" list="abilities" value="{{ $user->abilities }}">
                        <div id="selectedAbilities"></div>
                    </div>
                    <datalist id="abilities">
                        @foreach($allabilities as $ability)
                            <option ability_id="{{ $ability->id }}" value="{{ $ability->title }}"></option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="liste-h">
                <a href="{{ route('profile.offers') }}" class="btn-1 btn-2">Voir les offres postulées</a>
                <a href="#" class="btn-1 btn-2">voir les stats</a>
            </div>
            @break
        @case('pilote')
            <div id="promotions" class="container-1 area-bg">
                <p>Mes promotions :</p>
                <div class="liste-h ability_container">
                    @forelse($user->promotions as $promotion)
                        <div class="liste-h elements">
                            <a href="{{ route('promotions.users', $promotion->id) }}">{{ $promotion->name }}</a>
                            <a href="#abilities" ability_id="{{ $promotion->id }}" class="btn-3"><i class="fa-regular fa-circle-xmark"></i></a>
                        </div>
                    @empty
                        <p>Aucune compétence</p>
                    @endforelse
                </div>
                <div class="popup liste-h">
                    <button id="btn-plus" type="button" class="btn-3"><i class="fa-solid fa-plus"></i></button>
                    <dialog id="promotion" class="popup-content">
                        <ul>
                            @foreach($promotions as $promotion)
                                <li promotion_id="{{ $pormotion->id }}"><p>{{ $pormotion->name }}</p><a href="#" class="btn-3"><i class="fa-solid fa-plus"></i></a></li>
                            @endforeach
                        </ul>
                    </dialog>
                </div>
            </div>
            <div class="liste-h">
                <a href="{{ route('offers.index') }}" class="btn-1 btn-2">Voir les offres publiées</a>
                <a href="{{ route('companies.index') }}" class="btn-1 btn-2">Voir les entreprises</a>
                <a href="{{ route('profile.pending') }}" class="btn-1">Voir les utilisateurs en attente</a>
            </div>
            @break
    @endswitch
</div>
@vite('resources/js/promotion_ability.js')
@endsection
