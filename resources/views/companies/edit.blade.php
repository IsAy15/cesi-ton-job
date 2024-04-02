@extends('layouts.home')
@section('title', 'Modifier une entreprise')
@section('content')
@vite('resources/css/entreprise_localisations.css')

    <div class="container-1 default-bg fit-center">
        <h1>Modifier une entreprise</h1>
        <form action="{{ route('companies.update', $company->id) }}" method="post" class="form-v">
            @csrf
            @method('PUT')
            <div class="form-v">
                <div class="input-required fit-center">
                    <label for="cp_name">Nom de l'entreprise</label>
                    <input type="text" name="cp_name" id="cp_name" value="{{ $company->name }}">
                </div>
                <div class="input-required fit-center">
                    <label for="cp_sector">Secteur</label>
                    <input type="text" name="cp_sector" id="cp_sector" value="{{ $company->sector }}">
                </div>
                <div class="input-required fit-center">
                    <label for="cp_localization">Localisation(s)</label>
                    {{-- <input type="text" name="cp_localization" id="cp_localization" value="{{ $company->localization }}"> --}}
                    <div>
                        <div class="container">
                            <input id="searchInput" list="communes" placeholder="Localisations" value="{{ $company->localization }}">
                            <div id="selectedCommunes"></div>
                        </div>
                        <datalist id="communes"></datalist>
                        <input type="hidden" id="selectedCommunesInput" name="selectedCommunes">
                    </div>
                </div>
                <button type="submit" class="btn-1">Modifier</button>
            </div>
        </form>
    </div>
@endsection
@vite('resources/js/entreprise_localisations.js')
