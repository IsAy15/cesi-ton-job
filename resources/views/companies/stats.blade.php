@extends('layouts.home')
@section('title', 'Statistiques de l\'entreprise')
@section('content')
    <h1>Statistiques de l'entreprise {{ $company->name }}</h1>
    <p>Nombre total de candidatures : {{ $totalApplications }}</p>

    <h2>Liste des offres postées par l'entreprise :</h2>
    <ul>
        @foreach ($offers as $offer)
            <li>{{ $offer->title }}</li>
        @endforeach
    </ul>
    
    <a href="{{ route('companies.index') }}" class="btn btn-primary">Retour</a>
@endsection