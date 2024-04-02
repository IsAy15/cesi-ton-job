@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
    <div class="container-1 default-bg fit-center">
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
                    <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
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
        <a href="{{ route('offers.create') }}" class="btn-1 btn-2">Ajouter une offre&nbsp;<i class="fa-solid fa-plus"></i></a>
        @endif
    </div>
        <table id="offerTable" >
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Type</th>
                    <th>Entreprise</th>
                    <th>Promotion</th>
                    @if(Auth::user()->role !== 'user')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                <tr>
                    <td><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></td>
                    <td cp>{{ $offer->localization }}</td>
                    <td city></td>
                    <td data-starting-date>{{ $offer->starting_date }}</td>
                    <td data-ending-date>{{ $offer->ending_date }}</td>
                    <td data-type="{{ strtolower($offer->type) }}">{{ $offer->type }}</td>
                    <td data-company="{{ $offer->company->id }}">{{ $offer->company->name }}</td>
                    <td data-promotion="{{ $offer->promotion->id }}">{{ $offer->promotion->name }}</td>
                    @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
                    <td>
                        <div class="table-interactions">
                            <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@vite('resources/js/offer.js')
@vite('resources/js/geoapigouv.js')
@endsection
