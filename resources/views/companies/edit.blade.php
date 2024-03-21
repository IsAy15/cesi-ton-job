@extends('layouts.home')
@section('title', 'Modifier une entreprise')
@section('content')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h1>Modifier une entreprise</h1>
        <form action="{{ route('companies.update', $company->id) }}" method="post" class="form-v">
            @csrf
            @method('PUT')
            <div class="form-v">
                    <label for="cp_name">Nom de l'entreprise</label>
                    <input type="text" name="cp_name" id="cp_name" value="{{ $company->name }}">
                    <label for="cp_sector">Secteur</label>
                    <input type="text" name="cp_sector" id="cp_sector" value="{{ $company->sector }}">
                    <label for="cp_localization">Localisation</label>
                    <input type="text" name="cp_localization" id="cp_localization" value="{{ $company->localization }}">
                <button type="submit" class="btn-1">Modifier</button>
            </div>
        </form>
    </div>
@endsection