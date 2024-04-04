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
    <div id="companiesWithMostOffers">
        <h2>Les 3 entreprises avec le plus d'offres :</h2>
        <canvas data="{{ $companiesWithMostOffers }}"></canvas>
    </div>
    <div id="companiesWithMostApplications">
        <h2>Les 3 entreprises avec le plus de candidats :</h2>
        <canvas data="{{ $companiesWithMostApplications }}"></canvas>
    </div>
    <div id="sectorsWithMostCompanies">
        <h2>Les 3 secteurs les plus représentés :</h2>
        <canvas data="{{ $sectorsWithMostCompanies }}"></canvas>
    </div>
    <div id="departmentsWithMostCompanies">
        <h2>Les 3 départements avec le plus d'entreprises :</h2>
        <canvas data="{{ $departmentsWithMostCompanies }}"></canvas>
    </div>
</div>
@vite('resources/js/companies/stats.js')
@vite('resources/css/star_rate.css')
@vite('resources/js/star_rate.js')
@endsection
