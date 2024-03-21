@extends('layouts.home')
@section('title', 'Ajouter une entreprise')
@section('content')
@vite('resources/css/companies.css')
@vite('resources/css/brouillon-generale.css')
@vite('resources/css/checkmark.css')
    <div class="c-1 bg-1">
        <h1>Ajouter une entreprise</h1>
        <form action="{{ route('companies.store') }}" method="post" class="form-v">
            @csrf
            <div>
                <input type="text" name="cp_name" id="cp_name" placeholder="Nom de l'entreprise">
            </div>
            <div>
                <input type="text" name="cp_sector" id="cp_sector" placeholder="Secteur">
            </div>
            <div>
                <input type="text" name="cp_localization" id="cp_localization" placeholder="Localisation">
            </div>
            <div class="form-v">
                <label class="yolo">
                    <input type="checkbox" name="create_offer" id="create_offer" checked="checked">
                    <span class="checkmark"></span>
                </label>


                <label for="create_offer">Créer une offre après l'ajout de l'entreprise</label>
            </div>
            <button type="submit">Ajouter</button>
        </form>
@endsection
