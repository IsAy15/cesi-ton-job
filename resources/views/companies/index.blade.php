@extends('layouts.home')
@section('title', 'Liste des entreprises')
@section('content')
    <h1>Liste des Entreprises</h1>
    <input type="text" id="searchInput" placeholder="Rechercher une entreprise...">
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Ajouter une entreprise</a>

    @foreach ($companies as $company)
        <div class="company">
            <div class="infos">
                <h2><a href="{{ route('companies.stats', $company->id) }}">{{ $company->name }}</a></h2>
                <p>Secteur : {{ $company->sector }}</p>
                <p>Localisation : {{ $company->localization }}</p>
                <p>Moyenne des notes : {{ $company->average_grade }}</p>
            </div>
            <div class="actions">
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
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
@endsection
