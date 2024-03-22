@extends('layouts.home')
@section('title', 'Liste des entreprises')
@section('content')
@vite('resources/css/companies.css')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h1>Liste des Entreprises</h1>
        <input type="text" id="searchInput" placeholder="Rechercher une entreprise...">
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pilote')
        <a href="{{ route('companies.create') }}" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></a>
        @endif
        @foreach ($companies as $company)
            <div class="c-1 bg-2">
                <div class="liste-v">
                    <h2><a href="{{ route('companies.stats', $company->id) }}" class="clickable">{{ $company->name }}</a></h2>
                    <div class="liste-v">
                        <div class="space">
                            <p>Secteur :</p>
                            <p class="elements">{{ $company->sector }}</p>
                        </div>
                        <div class="space">
                            <p>Localisation :</p>
                            <p class="elements">{{ $company->localization }}</p>
                        </div>
                        <div class="space">
                            <p>Moyenne des notes :</p>
                            <p class="elements">{{ $company->average_grade }}</p>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pilote')
                <div class="liste-h">
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
                @endif
            </div>
        @endforeach
        <script>
            function filterCompanies() {
                var input, filter, companies, company, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                companies = document.getElementsByClassName("company");
                for (i = 0; i < companies.length; i++) {
                    company = companies[i].getElementsByClassName("infos")[0];
                    txtValue = company.textContent || company.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        companies[i].style.display = "";
                    } else {
                        companies[i].style.display = "none";
                    }
                }
            }

            document.getElementById("searchInput").addEventListener("keyup", filterCompanies);
        </script>
    </div>
@endsection
