@extends('layouts.home')
@section('title', 'Modifier une offre')
@section('content')
@vite('resources/css/offres-brouillon.css')
@vite('resources/css/brouillon-generale.css')
@if(Auth::user()->role != 'admin' && Auth::user()->role != 'pilote')
    <?php
        header('Location: /access-denied.php');
        exit();
    ?>
@endif
    <div class="c-1 bg-1 fit-center">
        <form action="{{ route('offers.update', $offer->id) }}" method="post" class="form-v">
            @csrf
            @method('PUT')
            <div class="input-required fit-center">
                <label for="of_company_id">Nom de l'entreprise</label>
                <select name="of_company_id" id="of_company_id">
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-required fit-center">
                <label for="of_title">Titre</label>
                <input type="text" name="of_title" id="of_title" value="{{ $offer->title }}">
            </div>
            <div class="input-required fit-center">
                <label for="of_type">Type</label>
                <input type="text" name="of_type" id="of_type" value="{{ $offer->type }}">
            </div>
            <div class="input-required fit-center">
                <label for="of_description">Description</label>
                <textarea name="of_description" id="of_description">{{ $offer->description }}</textarea>
            </div>
            <div class="input-required fit-center">
                <label for="of_localization">Localisation</label>
                <input type="text" name="of_localization" id="of_localization" value="{{ $offer->localization }}">
            </div>
            <div class="liste-h space">
            <div class="input-required">
                <label for="of_starting_date">Date de début</label>
                <input type="date" name="of_starting_date" id="of_starting_date" value="{{ $offer->starting_date }}">
            </div>
            <div class="input-required">
                <label for="of_ending_date">Date de fin</label>
                <input type="date" name="of_ending_date" id="of_ending_date" value="{{ $offer->ending_date }}">
            </div>
            </div>
            <div>
                <label for="of_places">Places disponibles</label>
                <input type="number" name="of_places" id="of_places" value="{{ $offer->places }}">
            </div>
            <div>
                <label for="of_salary">Salaire</label>
                <input type="number" name="of_salary" id="of_salary" value="{{ $offer->salary }}">
            </div>

            <button type="submit" class="btn-1">Modifier</button>
        </form>
    </div>
@endsection
