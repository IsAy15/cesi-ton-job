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
                <div class="liste-h ability_container"> 
                    @forelse($user->abilities as $ability)
                        <div class="liste-h elements">
                            <p>{{ $ability->title }}</p>
                            <a href="#admin" ability_id="{{ $ability->id }}" class="fa-regular fa-circle-xmark btn-1 btn-2"></a>
                        </div>
                    @empty
                        <p>Aucune compétence</p>
                    @endforelse
                    @if(!$allabilities->isEmpty())
                    <style>
                        .popup{
                            position: relative;
                            .popup-content{
                                position: absolute;
                                bottom: 0;
                                /* left: -5rem; */
                                z-index: 1;
                                padding: 1rem;
                                border-radius: 2rem;
                                ul{
                                    display: flex;
                                    flex-flow: column;
                                    gap: 1rem;
                                    li{
                                        display: flex;
                                        justify-content: space-between;
                                        gap: 1rem;
                                        align-items: center;
                                    }
                                }
                            }
                        }
                    </style>
                        
                    @endif
                </div>
                <div class="popup">
                    <dialog id="ability_popup" class="popup-content">
                        <ul>
                            @foreach($allabilities as $ability)
                                <li ability_id="{{ $ability->id }}"><p>{{ $ability->title }}</p><a href="#" class="btn-1 btn-2 fa-solid fa-plus"></a></li>
                            @endforeach
                        </ul>
                    </dialog>
                </div>
                <button id="btn-plus" type="button" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></button>
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
