@extends('layouts.home')
@section('title', 'Ajouter une offre')
@section('content')
@vite('resources/css/offer.css')
@if(Auth::user()->role != 'admin' && Auth::user()->role != 'pilote')
    <?php
        header('Location: /access-denied.php');
        exit();
    ?>
@endif
    <div class="container-1 default-bg fit-center">
        <h1>Ajouter une offre</h1>
        <form action="{{ route('offers.store') }}" method="post" class="form-v">
            @csrf
                <select name="of_company_id" id="of_company_id">
                    <option value="" disabled selected hidden>Entreprise</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="of_title" id="of_title" placeholder="Titre">
                <input type="text" name="of_type" id="of_type" placeholder="Type">
                <textarea type="text" name="of_description" id="of_description" placeholder="Description"></textarea>
                <input type="text" name="of_localization" id="of_localization" placeholder="Code postal">
            
            <div class="liste-h space">
                <div class="input-required">
                    <label for="of_starting_date">Date de début</label>
                    <input type="date" name="of_starting_date" id="of_starting_date">
                </div>
                <div class="input-required">
                    <label for="of_ending_date">Date de fin</label>
                    <input type="date" name="of_ending_date" id="of_ending_date">
                </div>
            </div>
            <div>
                <label for="of_places">Places disponibles</label>
                <input type="number" name="of_places" id="of_places">
            </div>
            <div>
                <label for="of_salary">Salaire (/mois)</label>
                <input type="number" name="of_salary" id="of_salary">
            </div>
            <button type="submit" class="btn-1">Ajouter</button>
        </form>
    </div>
@endsection