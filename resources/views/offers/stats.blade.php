@extends('layouts.home')
@section('title', 'Données des offres')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Statistiques des offres</h1>
        <h2>Offres avec le plus de candidatures</h2>
        <ul>
        @foreach($offersWithMostApplications as $offer)
        <li>
            <a href="{{ route('offers.show', $offer->id) }}" class="clickable">{{ $offer->title }}</a> 
            - {{ $offer->applications_count }} candidatures - {{ $offer->company->name }}
        
    </li>
    @endforeach

        </ul>

        <h2>Offres les plus ajoutées à la wishlist</h2>
        <ul>
            @foreach($offersInWishlist as $offer)
            <li>
                <a href="{{ route('offers.show', $offer->id) }}" class="clickable">{{ $offer->title }}</a>
            </li>
            @endforeach
        </ul>

        <h2>Les 3 compétences les plus demandées</h2>
        <ul>
            @foreach($topAbilities as $ability)
                <li>{{ $ability->title }}</li>
            @endforeach
        </ul>

        <h2>Offre avec la durée de stage la plus longue</h2>
        @php
        $origin = new DateTimeImmutable($offer->starting_date);
        $duration = $origin->diff(new DateTimeImmutable($offer->ending_date));
        @endphp
        <p>
        <a href="{{ route('offers.show', $offer->id) }}" class="clickable">{{ $longestInternshipOffer->title }}</a> - {{ $duration->format('%a jours') }}
    </p>

        <h2>Départements avec le plus d'offres</h2>
        <ul>
            @foreach($departmentsWithMostOffers as $department)
                <li><span dep="{{ $department->dep }}"></span> - <span count>{{ $department->offers_count }}</span> offres</li>
            @endforeach
        </ul>
        <canvas id="departmentsWithMostOffers"></canvas>
    </div>
    @vite('resources/js/geoapigouv.js')
    @vite('resources/js/offers_stats.js')
@endsection
