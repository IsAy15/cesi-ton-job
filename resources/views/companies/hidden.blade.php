@extends('layouts.home')
@section('title', 'Entreprises cachées')
@section('content')
<div class="container-1 default-bg fit-center">
    <h1>Entreprises cachées</h1>
    @foreach($hiddenCompanies as $company)
    <div class="container-1 area-bg">
        <h2>{{ $company->name }}</h2>
        <div class="liste-h">
            <p>Secteur:</p>
            <p>{{ $company->sector }}</p>
        </div>
        <div class="liste-h">
            <div>
            <p>Localisation(s) : </p>
            </div>
            <div>
            @foreach ($company->localizations as $localization)               
            <p city>{{ $localization->nom }} ({{ $localization->cp }})</p>
            @endforeach
            </div>
        </div>
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
@endsection
