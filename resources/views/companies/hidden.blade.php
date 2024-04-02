@extends('layouts.home')
@section('title', 'Entreprises cachées')
@section('content')
<div class="container-1 default-bg fit-center">
    <div class="input-required fit-center">
        <h1>Entreprises cachées</h1>
        <div class="form-v companies-container">
            @foreach($hiddenCompanies as $company)
            <div class="container-2 area-bg fit-center">
                <h2>{{ $company->name }}</h2>
                <p>Secteur: {{ $company->sector }}</p>
                <p>Localisation(s) : </p>
                @foreach ($company->localizations as $localization)               
                <p city>{{ $localization->nom }} ({{ $localization->cp }})</p>
                @endforeach
                <div class="liste-h">
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    <form action="{{ route('companies.active', $company->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
