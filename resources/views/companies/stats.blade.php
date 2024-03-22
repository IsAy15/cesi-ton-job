@extends('layouts.home')
@section('title', 'Statistiques de l\'entreprise')
@section('content')
@vite('resources/css/companies.css')
@vite('resources/css/brouillon-generale.css')
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
@endsection
