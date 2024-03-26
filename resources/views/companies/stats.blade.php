@extends('layouts.home')
@vite('resources/css/companies.css')
@vite('resources/css/brouillon-generale.css')
@section('title', 'Statistiques de l\'entreprise')
@section('content')
    <div class="c-1 bg-1 fit-center">
        <h1>{{ $company->name }}</h1>
        <h2>Offres postées par l'entreprise :</h2>
        <div class="form-v">
            @foreach ($offers as $offer)
                <p><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></p>
            @endforeach
        </div>
        <p>Nombre total d'offres : {{ $offers->count() }}</p>
        
        <a href="{{ route('companies.index') }}" class="btn-1">Retour</a>
    </div>
    <div class="c-1 bg-1 fit-center">
        <form>
            <h1>Vous connaissez cette entreprise ?</h1>
            <h2>Donnez votre avis :</h2>
            <div class="ratings">
                <span data-rating="5">&#9733;</span>
                <span data-rating="4">&#9733;</span>
                <span data-rating="3">&#9733;</span>
                <span data-rating="2">&#9733;</span>
                <span data-rating="1">&#9733;</span>
            </div>
            <input type="hidden" name="rating" id="rating">
            <input type='submit' value='Envoyer' class="btn-1">
        </form>
	</div>
    @vite('resources/js/star_rate.js')
    @vite('resources/css/star_rate.css')
@endsection
