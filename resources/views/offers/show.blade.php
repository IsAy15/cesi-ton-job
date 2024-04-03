@extends('layouts.home')
@section('title', 'Détails de l\'offre')
@section('content')
@vite('resources/css/offer.css')

<div class="container-1 default-bg fit-center">
    <div class="space">
        <h1>{{ $offer->title }}</h1>
        @if ($isInWishlist)
            <form action="{{ route('wishlist.remove', $offer->id) }}" method="post">
                @csrf
                @method('DELETE') <!-- Ajout de la méthode DELETE -->
                <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-heart"></i></button>
            </form>
        @else
            <form action="{{ route('wishlist.add', $offer->id) }}" method="post">
                @csrf
                <button type="submit" class="btn-1 btn-2"><i class="fa-regular fa-heart"></i></button>
            </form>
        @endif
    </div>
    @auth
    @endauth
    <div class="container-2 area-bg liste-v">
        <h2>{{ $offer->company->name }}</h2>
        <p>Type de contrat: {{ $offer->type }}</p>
        <p>{{ $offer->description }}</p>
        @php
            $offer->localization = json_decode($offer->localization);
        @endphp
        <p>Ville : <span>{{ $offer->localization->nom }}</span> (<span>{{ $offer->localization->cp }}</span>)</p>
        <div class="space">
            <p>Date de début : {{ $offer->starting_date }}</p>
            <p>Date de fin : {{ $offer->ending_date }}</p>
        </div>
        <p>Niveau requis :
            @foreach($offer->levels as $level)
            {{ $level->title }}
            @endforeach
        </p>
        <p>Promotion : {{ $offer->promotion->name }}</p>
        <p>Salaire : {{ $offer->salary }}</p>
        <div>
            <p>Places disponibles : {{ $offer->places }}</p>
            <p>Nombres de candidatures : {{ $offer->applies_count }}</p>
        </div>

        <h3>Compétences requises :</h3>
        <ul>
            @foreach($offer->abilities as $ability)
                <li>{{ $ability->title }}</li>
            @endforeach
        </ul>
        @if($user->role !== 'user' && $offer->status == 'hidden')
        <p>Statut : {{ $offer->status }}</p>
        @endif

    </div>
    @auth
        @if ($user->role !== 'pilote' && !$isApplied)
            <form id="application" action="{{ route('offers.apply', $offer->id) }}" method="POST" class="form-v" enctype="multipart/form-data">
                @csrf
                <div class="liste-h">
                    <div class="input-required">
                        <input type="file" id="cv" name="cv" class="inputfile">
                        <label for="cv" class="clickable">Upload CV</label>
                        <p id="cvFileName" class="file-name"></p>
                    </div>
                    <div class="input-required">
                        <input type="file" id="letter" name="letter" class="inputfile">
                        <label for="letter" class="clickable">Lettre de motivation</label>
                        <p id="letterFileName" class="file-name"></p>
                    </div>
                </div>
                <button type="submit" class="btn-1 btn-2">Postuler</button>
            </form>
        @endif
        @if($user->role !== 'pilote'&& $isApplied)
            <div class="space">
            <a href="{{ Storage::url($application->cv) }}" download="{{ $application->cv }}">Télécharger le CV</a>
            <a href="{{ Storage::url($application->letter) }}" download="{{ $application->letter }}">Télécharger la lettre de motivation</a>
            </div>
        @endif
    @endauth

    <a href="{{ route('offers.index') }}" class="btn-1">Retour</a>
</div>

@vite('resources/js/file.js')
@endsection
