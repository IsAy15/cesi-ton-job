@extends('layouts.home')
@section('title', 'Statistiques de l\'entreprise')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>{{ $company->name }}</h1>
        <div>
            <p>Secteur d'activité : {{ $company->sector }}</p>
            <p>Note moyenne : </p><div note="{{ $company->average_grade }}"></div>
            <p>Localisation(s) : </p>
            @foreach ($localizations as $localization)
                <p city>{{ $localization }}</p>
            @endforeach
        </div>
        <div>
            <h2>Offres postées par l'entreprise :</h2>
            <div class="form-v">
                @foreach ($offers as $offer)
                    <p><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></p>
                @endforeach
            </div>
        </div>
        <p>Nombre total d'offres : {{ $offers->count() }}</p>
        
        <a href="{{ route('companies.index') }}" class="btn-1">Retour</a>
    </div>
    <div class="container-1 default-bg fit-center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $userId = auth()->id();
            $existingGrade = $company->grades()->where('user_id', $userId);
        @endphp

        <form action="{{ route('companies.rate') }}" method="POST">
            @csrf
            <h1>Vous connaissez cette entreprise ?</h1>
            <h2>Donnez votre avis :</h2>
            <div class="ratings active" note="{{ $existingGrade->value('value') }}"></div>
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            <input type="hidden" name="rating" id="rating">
            <input type="submit" value="Envoyer" class="btn-1">
        </form>
    </div>
    @vite('resources/js/star_rate.js')
    @vite('resources/css/star_rate.css')
    @vite('resources/js/postal.js')
@endsection
