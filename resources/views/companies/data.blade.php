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
    <h2>Moyenne des notes : <div note={{ $averageGrade }}></div></h2>
    <h2>Entreprise avec le plus d'offres : {{ $companyWithMostOffers->name }}</h2>
    <h2>Entreprise avec le plus de candidat : {{ $companyWithMostApplications->name }}</h2>
    <h2>Secteur le plus représenté : {{ $sectorWithMostCompanies->sector}}</h2>
    <h2>Département avec le plus d'entreprises : <span dep="{{ $departmentWithMostCompanies->code }}"></span></h2>
</div>
@vite('resources/js/departement.js')
@vite('resources/css/star_rate.css')
@vite('resources/js/star_rate.js')
@endsection
