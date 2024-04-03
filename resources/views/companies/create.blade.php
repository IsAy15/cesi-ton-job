@extends('layouts.home')
@section('title', 'Ajouter une entreprise')
@section('content')
@vite('resources/css/checkmark.css')
@vite('resources/css/entreprise_localisations.css')
    <div class="container-1 default-bg fit-center">
        <h1>Ajouter une entreprise</h1>
        <form action="{{ route('companies.store') }}" method="post" class="form-v">
            @csrf
            <div>
                <input type="text" name="cp_name" id="cp_name" placeholder="Nom de l'entreprise">
            </div>
            <div>
                <div class="container">
                    <input id="searchInput" list="communes"  placeholder="Localisations">
                    <div id="selectedCommunes"></div>
                </div>
                <datalist id="communes"></datalist>
                <input type="hidden" id="selectedCommunesInput" name="selectedCommunes">
            </div>
            <div>
                <select name="cp_sector" id="cp_sector">
                    <option value="" selected>Choisir un secteur</option>
                    <option value="Informatique">Informatique</option>
                    <option value="S3E">S3E</option>
                    <option value="Générale">Générale</option>
                    <option value="BTP">BTP</option>
                </select>
            </div>
            <div class="form-v">
                <label for="create_offer">Créer une offre après l'ajout de l'entreprise</label>
                <input type="checkbox" name="create_offer" id="create_offer" @if($create_offer) checked @endif>
            </div>
            <button type="submit" class="btn-1">Ajouter</button>
        </form>
    </div>
        

@vite('resources/js/entreprise_localisations.js')
@vite('resources/js/entreprise_validation.js')
@vite('resources/js/companies/champ_obligatoire.js')
@endsection
