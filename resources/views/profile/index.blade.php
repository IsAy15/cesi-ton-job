@extends('layouts.home')
@section('title', 'Votre profil')
@section('content')
@vite('resources/css/profile.css')
    <div class="c-1">
        <div id="infos_perso" class="bandeau-1">
            <div id="infos" class="infos">
                <div id="nom"class="c-1 c-2">
                    <p>{{ $user->lastname }}</p>
                </div>
                <div id="prenom"class="c-1 c-2">
                    <p>{{ $user->firstname }}</p>
                </div>
                <div id="email" class="c-1 c-2">
                    <p>{{ $user->email }}</p>
                </div>
                <div id="promo" class="c-1 c-2">
                    <p>{{ $user->role }}</p>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('profile.offers') }}" class="btn btn-primary">Voir les offres postulées</a>
        </div>
        <div>
            <a href="{{ route('profile.wishlist') }}" class="btn btn-primary">View Wishlist</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Votre profil</div>
                        <div class="card-body">
                            @if($user->promotions->isNotEmpty())
                                <div>
                                    <h4>Promotion:</h4>
                                    <ul>
                                        @foreach($user->promotions as $promotion)
                                            <li>{{ $promotion->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('profile.offers') }}" class="btn btn-primary">Voir les offres postulées</a>
                            </div>
                            <div>
                                <a href="{{ route('profile.wishlist') }}" class="btn btn-primary">View Wishlist</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection