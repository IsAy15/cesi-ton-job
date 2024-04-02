@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
    <div class="container-1 default-bg fit-center">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="input-required fit-center">
            <h1>Offres d'emploi</h1>
            <form>
                <div class="liste-h search-bar">
                    <input type="text" id="keywordInput" placeholder="Mot-clés" class="">
                    <h2>|</h2>
                    <input type="text" id="locationInput" placeholder="Localisation" class="input-search-bar">
                    <a href="#" id="searchButton" class="btn-1 btn-2"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <a href="#" id="filterButton" class="btn-1 btn-2"><i class="fa-solid fa-filter"></i></a>
                </div>
            </form>
            <div class="filters" style="display: none;">
                <select id="contractFilter">
                    <option value="all">Tous types de contrat</option>
                    @foreach($contractTypes as $contractType)
                    <option value="{{ $contractType }}">{{ ucfirst($contractType) }}</option>
                    @endforeach
                </select>
                <select id="durationFilter">
                    <option value="all">Toutes durées</option>
                    <option value="short">Courte durée</option>
                    <option value="medium">Durée moyenne</option>
                    <option value="long">Longue durée</option>
                    <option value="very_long">Très longue durée</option>
                </select>
                <select id="promotionFilter">
                    <option value="all">Toutes les promotions</option>
                    @foreach ($promotions as $promotion)
                    <option value="{{ $promotion->id }}" @if(auth()->user()->role == "user" && $promotion->id == auth()->user()->promotions[0]->id) selected @endif
                        >{{ $promotion->name }}</option>
                    @endforeach
                </select>
                <select id="companyFilter">
                    <option value="all">Toutes les entreprises</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="liste-h">
        <a href="{{ route('offers.stats') }}" class="btn-1 btn-2">Afficher les statistiques&nbsp;<i class="fa-solid fa-chart-simple"></i></a>
        @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
        <a href="{{ route('offers.hidden') }}" class="btn-1 btn-2">Afficher les offres cachées&nbsp;<i class="fa-solid fa-eye-slash"></i></a>
        <a href="{{ route('offers.create') }}" class="btn-1 btn-2">Ajouter une offre&nbsp;<i class="fa-solid fa-plus"></i></a>
        @endif
    </div>
    <div class="form-v offers-container">
        @foreach ($offers as $offer)
            <div offer="{{ $offer->id }}" class="container-2 area-bg">
                <h2><a title href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></h2>
                <div class="space">
                    <p contract>{{ $offer->type }}</p>
                    <p promo="{{ $offer->promotion->id }}">{{ $offer->promotion->name }}</p>
                </div>
                <div class="space">
                    @php
                        $origin = new DateTimeImmutable($offer->starting_date);
                        $duration = $origin->diff(new DateTimeImmutable($offer->ending_date));
                    @endphp
                    <p start>Début : {{ $origin->format('d/m/Y') }}</p>
                    <p duration="{{ $duration->format("%a") }}">Durée : {{ $duration->format('%a jours') }}</p>
                </div>
                <div class="space">
                    <p company={{ $offer->company->id}}>{{ $offer->company->name }}</p>
                    <div>
                        <p>
                            <span city></span> (<span cp>{{ $offer->localization }}</span>)
                        </p>
                    </div>
                </div>
                @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
                    <div class="liste-h">
                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <form action="{{ route('offers.hide', $offer->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-eye-slash"></i></button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    </div>
@vite('resources/js/offer.js')
@vite('resources/js/geoapigouv.js')
@endsection
