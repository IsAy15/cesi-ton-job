@extends('layouts.home')
@section('title', 'Données des offres')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Statistiques des offres</h1>
        <h2>Offres avec le plus de candidatures</h2>
        <ul>
            @foreach($offersWithMostApplications as $offer)
                <li>{{ $offer->title }} - {{ $offer->applications_count }} candidatures</li>
            @endforeach
        </ul>

        <h2>Offres les plus ajoutées à la wishlist</h2>
        <ul>
            @foreach($offersInWishlist as $offer)
                <li>{{ $offer->title }}</li>
            @endforeach
        </ul>

        <h2>Les 3 compétences les plus demandées</h2>
        <ul>
            @foreach($topAbilities as $ability)
                <li>{{ $ability->title }}</li>
            @endforeach
        </ul>

        <h2>Offre avec la durée de stage la plus longue</h2>
        <p>{{ $longestInternshipOffer->title }}</p>

        <h2>Départements avec le plus d'offres</h2>
        <ul>
            @foreach($departmentsWithMostOffers as $department)
                <li><span dep="{{ $department->code }}">{{ $department->code }}</span> - <span class='count'>{{ $department->offers_count }}</span> offres</li>
            @endforeach
        </ul>
    </div>
    @vite('resources/js/departement.js')
@endsection
