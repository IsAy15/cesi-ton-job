@extends('layouts.home')
@section('title', 'Modifier une entreprise')
@section('content')
    <form action="{{ route('companies.update', $company->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="cp_name">Nom de l'entreprise</label>
            <input type="text" name="cp_name" id="cp_name" value="{{ $company->name }}">
        </div>
        <div>
            <label for="cp_sector">Secteur</label>
            <input type="text" name="cp_sector" id="cp_sector" value="{{ $company->sector }}">
        </div>
        <div>
            <label for="cp_localization">Localisation</label>
            <input type="text" name="cp_localization" id="cp_localization" value="{{ $company->localization }}">
        </div>
        <button type="submit">Modifier</button>
    </form>
@endsection
