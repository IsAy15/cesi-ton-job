@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
<h1>Offres d'emploi</h1>
<div class="container">
    <form>
        <div class="wrapper">
            <p>Cherchez l'offre qui vous correspond</p>
            <div class="search-container">
                <input type="text" id="keywordInput" class="search" placeholder="Mot-clés">
                <input type="text" id="locationInput" class="location" placeholder="Localisation">
                <a href="#" class="button" id="searchButton">Rechercher</a>
            </div>
        </div>
    </form>
</div>


    <a href="{{ route('offers.create') }}" class="btn-1 btn-2">Ajouter une offre</a>
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
                        <a href="{{ route('offers.edit', $offer->id) }}">Modifier</a>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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