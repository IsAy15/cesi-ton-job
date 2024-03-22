@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offres-brouillon.css')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h1>Offres d'emploi</h1>
        <div>
            <form>
                <div class="liste-h search-bar">
                    <input type="text" id="keywordInput" placeholder="Mot-clés" class="">
                    <h2>|</h2>
                    <input type="text" id="locationInput" placeholder="Localisation" class="input-search-bar">
                    <a href="#" id="searchButton" class="btn-1 btn-2"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
            </form>
        </div>
        @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
            <a href="{{ route('offers.create') }}" class="btn-1 btn-2">Ajouter une offre</a>
        @endif
        <table id="offerTable">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Type</th>
                    <th>Entreprise</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <td><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></td>
                        <td class="code-postal">{{ $offer->localization }}</td>
                        <td class="ville"></td> 
                        <td>{{ $offer->starting_date }}</td>
                        <td>{{ $offer->ending_date }}</td>
                        <td>{{ $offer->type }}</td>
                        <td>{{ $offer->company->name }}</td>
                        <td>
                            <div class="table-interactions">
                                <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var postalCodes = document.querySelectorAll('.code-postal');
        postalCodes.forEach(function(postalCodeElement) {
            var postalCode = postalCodeElement.textContent.trim();
            fetch('https://api-adresse.data.gouv.fr/search/?q=' + postalCode)
                .then(response => response.json())
                .then(data => {
                    if (data.features.length > 0) {
                        var city = data.features[0].properties.city;
                        postalCodeElement.nextElementSibling.textContent = city;
                    }
                })
                .catch(error => console.error('Erreur lors de la récupération de la ville :', error));
        });

        document.getElementById('searchButton').addEventListener('click', function(event) {
            event.preventDefault();
            var keyword = document.getElementById('keywordInput').value.toUpperCase();
            var location = document.getElementById('locationInput').value.toUpperCase();
            var tableRows = document.querySelectorAll('#offerTable tbody tr');
            tableRows.forEach(function(row) {
                var title = row.querySelector('td:first-child').textContent.toUpperCase();
                var postalCode = row.querySelector('.code-postal').textContent.toUpperCase();
                var city = row.querySelector('.ville').textContent.toUpperCase();
                if (title.includes(keyword) && (postalCode.includes(location) || city.includes(location))) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection