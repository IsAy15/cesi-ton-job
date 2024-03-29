@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
@vite('resources/css/pagination.css')
@vite('resources/js/pagination.js')

    <div class="container-1 default-bg fit-center">
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
        <a href="{{ route('offers.data') }}" class="btn-1 btn-2">Afficher les données</a>
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
                    <th>Promotion</th>
                    @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($pagedOffers as $offer)
                    <tr>
                        <td><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></td>
                        <td cp>{{ $offer->localization }}</td>
                        <td city></td> 
                        <td>{{ $offer->starting_date }}</td>
                        <td>{{ $offer->ending_date }}</td>
                        <td>{{ $offer->type }}</td>
                        <td>{{ $offer->company->name }}</td>
                        <td>{{$offer->promotion->name}}</td>
                        @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
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
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="pagination" id="paginationContainer">
            <ul>
                @for ($i = 1; $i <= $totalPages; $i++)
                    <li>
                        <a href="{{ route('offers.index') }}?page={{ $i }}" class="{{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
    <script>
//Fais un script en js qui fait fonctionner la pagination
//quand la page est supérieur à 1, la pagination doit être visible
//quand la page est supérieur à 1, un bouton "précédent" doit être visible sur la gauche
//quand la page est inférieur à totalPages, un bouton "suivant" doit être visible sur la droite
//quand il y a plus de 5 pages, des boutons "..." doivent être visible pour naviguer entre les pages
//quand il y a plus de 5 pages, des boutons ">>" et "<<" doivent être visible pour naviguer entre les pages
//Un seule pagination doit être visible à la fois
//Les boutons "précédent" et "suivant" doivent être désactivés quand ils ne sont pas utilisables
//Les boutons "..." doivent être désactivés quand ils ne sont pas utilisables
//Les boutons ">>" et "<<" doivent être désactivés quand ils ne sont pas utilisables
document.addEventListener('DOMContentLoaded', function() {
    const paginationContainer = document.getElementById('paginationContainer');
    const pagination = paginationContainer.querySelector('ul');
    const currentPage = parseInt("{{ $currentPage }}");
    const totalPages = parseInt("{{ $totalPages }}");

    if (totalPages > 1) {
        if (currentPage > 1) {
            const previousButton = document.createElement('li');
            previousButton.innerHTML = `<a href="{{ route('offers.index') }}?page=${currentPage - 1}">Précédent</a>`;
            pagination.appendChild(previousButton);
        }

        if (currentPage > 5) {
            const firstButton = document.createElement('li');
            firstButton.innerHTML = `<a href="{{ route('offers.index') }}?page=1">1</a>`;
            pagination.appendChild(firstButton);
        }

        if (currentPage > 6) {
            const previousDots = document.createElement('li');
            previousDots.innerHTML = `<a href="#">...</a>`;
            pagination.appendChild(previousDots);
        }

        for (let i = currentPage - 4; i <= currentPage + 4; i++) {
            if (i > 0 && i <= totalPages) {
                const pageButton = document.createElement('li');
                pageButton.innerHTML = `<a href="{{ route('offers.index') }}?page=${i}" class="${i === currentPage ? 'active' : ''}">${i}</a>`;
                pagination.appendChild(pageButton);
            }
        }

        if (currentPage < totalPages - 5) {
            const nextDots = document.createElement('li');
            nextDots.innerHTML = `<a href="#">...</a>`;
            pagination.appendChild(nextDots);
        }

        if (currentPage < totalPages - 4) {
            const lastButton = document.createElement('li');
            lastButton.innerHTML = `<a href="{{ route('offers.index') }}?page=${totalPages}">${totalPages}</a>`;
            pagination.appendChild(lastButton);
        }

        if (currentPage < totalPages) {
            const nextButton = document.createElement('li');
            nextButton.innerHTML = `<a href="{{ route('offers.index') }}?page=${currentPage + 1}">Suivant</a>`;
            pagination.appendChild(nextButton);
        }
    }
});


</script>



@vite('resources/js/offer.js')
@vite('resources/js/postal.js')
@endsection
