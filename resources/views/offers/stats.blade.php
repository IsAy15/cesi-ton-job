@extends('layouts.home')
@section('title', 'Données des offres')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Statistiques des offres</h1>
        <h2>Offres avec le plus de candidatures</h2>
        <ul>
            @foreach($offersWithMostApplications as $offer)
                <li><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a> - {{ $offer->applications_count }} candidatures</li>
            @endforeach
        </ul>

        <h2>Offres les plus ajoutées aux favoris</h2>
        <ul>
            @foreach($offersInWishlist as $offer)
                <li><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a> - {{ $offer->wishlist_count }} mise en favoris</li>
            @endforeach
        </ul>
        <div id="topAbilities">
            <h2>Les 3 compétences les plus demandées</h2>
            <canvas data="{{ $topAbilities }}"></canvas>
        </div>

        <h2>Offre avec la durée la plus longue</h2>
        @php
            $origin = new DateTimeImmutable($longestInternshipOffer->starting_date);
            $duration = $origin->diff(new DateTimeImmutable($longestInternshipOffer->ending_date));
        @endphp
        <p><a href="{{ route('offers.show', $longestInternshipOffer->id) }}">{{ $longestInternshipOffer->title }}</a> - {{ $duration->format("%a") }} jours</p>

        <div id="departmentsWithMostOffers">
            <h2>Les 5 départements avec le plus d'offres</h2>
            <canvas data="{{ $departmentsWithMostOffers }}"></canvas>
        </div>
    </div>
    @vite('resources/js/offers_stats.js')
@endsection
