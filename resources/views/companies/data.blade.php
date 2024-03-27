@extends('layouts.home')
@section('title', 'Données des entreprises')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-1 default-bg fit-center">
    <h1>Statistiques des entreprises</h1>
    <h2>Moyenne des notes des entreprises : {{ $averageGrade }}</h2>
    <h2>Entreprise avec le plus d'offres: {{ $companyWithMostOffers->name }}</h2>
    <h2>Entreprise avec le plus de candidat: {{ $companyWithMostApplications->name }}</h2>
    <h2>Secteur le plus representé: {{ $sectorWithMostCompanies->sector}}</h2>
</div>

@endsection
