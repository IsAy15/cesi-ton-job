@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/abilities.css')
<div class="container-1 default-bg fit-center">
    <div id="infos_perso" class="liste-h">
    <div id="photo" class="container-rond">
    <img src="/uploads/avatars/{{ $user->avatar }}" alt="Photo de profil">
</div>
        <div id="infos" class="liste-v">
            <p>{{ $user->lastname }}</p>
            <p>{{ $user->firstname }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->campus }}</p>
            @if($user->role === 'user')
            <p>{{ $title }}</p>
            @endif
            @if($user->role !=='admin')
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
                        @foreach($allAbilities as $ability)
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
                <p>Mes niveaux :</p>
                <div class="liste-h ability_container">
                    @foreach($user->userLevels as $userLevel)
                        <div class="liste-h elements">
                        <p>{{ $userLevel->level->title }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="popup liste-h">
                    <dialog id="promotion" class="popup-content">
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
