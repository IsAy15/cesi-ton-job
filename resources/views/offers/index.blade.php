@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
    <div class="container-1 default-bg fit-center">
        <h1>Offres d'emploi</h1>
        <div>
            <form>
                <div class="liste-h search-bar">
                        <input type="text" id="keywordInput" placeholder="Mot-clés" class="">
                        <h2>|</h2>
                        <input type="text" id="locationInput" placeholder="Localisation" class="input-search-bar">
                    <a href="#" id="searchButton" class="btn-1 btn-2"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
            </form>
        </div>
        <a href="{{ route('offers.data') }}" class="btn-1 btn-2">Afficher les données</a>
        @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
            <a href="{{ route('offers.create') }}" class="btn-1 btn-2">Ajouter une offre</a>
        @endif
        <table id="offerTable">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Type</th>
                    <th>Entreprise</th>
                    @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
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
                        <td>{{ $offer->starting_date }}</td>
                        <td>{{ $offer->ending_date }}</td>
                        <td>{{ $offer->type }}</td>
                        <td>{{ $offer->company->name }}</td>
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
@vite('resources/js/postal.js')
@endsection