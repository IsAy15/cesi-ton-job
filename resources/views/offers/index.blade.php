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

        <div class="filters">
            <select id="contractFilter">
                <option value="all">Tous types de contrat</option>
                @foreach($contractTypes as $contractType)
                <option value="{{ $contractType }}">{{ ucfirst($contractType) }}</option>
                @endforeach
            </select>


            <select id="durationFilter">
                <option value="all">Toutes durées</option>
                <option value="short">Courte durée</option>
                <option value="medium">Durée moyenne</option>
                <option value="long">Longue durée</option>
                <option value="very_long">Très longue durée</option>
            </select>

            <select id="promotionFilter">
                <option value="all">Toutes les promotions</option>
                @foreach ($promotions as $promotion)
                <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                @endforeach
            </select>

            <select id="companyFilter">
                <option value="all">Toutes les entreprises</option>
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
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
                <td city>({{ $offer->localization }})</td>
                <td data-starting-date>{{ $offer->starting_date }}</td>
                <td data-ending-date>{{ $offer->ending_date }}</td>
                <td data-type="{{ strtolower($offer->type) }}">{{ $offer->type }}</td>
                <td data-company="{{ $offer->company->id }}">{{ $offer->company->name }}</td>
                <td data-promotion="{{ $offer->promotion->id }}">{{ $offer->promotion->name }}</td>
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
            @for ($i = 1; $i <= $totalPages; $i++) <li>
                <a href="{{ route('offers.index') }}?page={{ $i }}" class="{{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
                </li>
                @endfor
        </ul>
    </div>
</div>
<script>
       //Filtre JS pour le type de contrat
       document.addEventListener('DOMContentLoaded', function() {
    const contractFilter = document.getElementById('contractFilter');
    const offerTable = document.getElementById('offerTable').getElementsByTagName('tbody')[0];
    const offers = offerTable.getElementsByTagName('tr');

    contractFilter.addEventListener('change', function() {
        const selectedContract = contractFilter.value.toLowerCase();

        for (let i = 0; i < offers.length; i++) {
            const offerContract = offers[i].querySelector('[data-type]').getAttribute('data-type').toLowerCase();

            if (selectedContract === 'all' || offerContract === selectedContract) {
                offers[i].style.display = ''; 
            } else {
                offers[i].style.display = 'none'; 
            }
        }
    });
});
    



    document.addEventListener('DOMContentLoaded', function() {
        const durationFilter = document.getElementById('durationFilter');
        const offerTable = document.getElementById('offerTable').getElementsByTagName('tbody')[0];
        const offers = offerTable.getElementsByTagName('tr');

        durationFilter.addEventListener('change', function() {
            const selectedDuration = durationFilter.value;

            for (let i = 0; i < offers.length; i++) {
                const offerDuration = calculateDuration(offers[i].querySelector('[data-starting-date]').innerText, offers[i].querySelector('[data-ending-date]').innerText);

                if (selectedDuration === 'all' || offerDuration === selectedDuration) {
                    offers[i].style.display = ''; 
                } else {
                    offers[i].style.display = 'none'; 
                }
            }
        });
    });

    function calculateDuration(startingDateStr, endingDateStr) {
        const startingDate = new Date(startingDateStr);
        const endingDate = new Date(endingDateStr);
        const diffTime = Math.abs(endingDate - startingDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Conversion en jours

        if (diffDays <= 90) {
            return 'short';
        } else if (diffDays <= 180) { 
            return 'medium';
        } else if (diffDays <= 365) {
            return 'long';
        } else {
            return 'very-long'; 
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const promotionFilter = document.getElementById('promotionFilter');
        const companyFilter = document.getElementById('companyFilter');
        const offerTable = document.getElementById('offerTable').getElementsByTagName('tbody')[0];
        const offers = offerTable.getElementsByTagName('tr');

        promotionFilter.addEventListener('change', function() {
            const selectedPromotionId = promotionFilter.value;

            for (let i = 0; i < offers.length; i++) {
                const offerPromotionId = offers[i].querySelector('[data-promotion]').getAttribute('data-promotion');

                if (selectedPromotionId === 'all' || offerPromotionId === selectedPromotionId) {
                    offers[i].style.display = ''; 
                } else {
                    offers[i].style.display = 'none'; 
                }
            }
        });

        companyFilter.addEventListener('change', function() {
            const selectedCompanyId = companyFilter.value;

            for (let i = 0; i < offers.length; i++) {
                const offerCompanyId = offers[i].querySelector('[data-company]').getAttribute('data-company');

                if (selectedCompanyId === 'all' || offerCompanyId === selectedCompanyId) {
                    offers[i].style.display = ''; 
                } else {
                    offers[i].style.display = 'none'; 
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    const contractFilter = document.getElementById('contractFilter');
    const durationFilter = document.getElementById('durationFilter');
    const promotionFilter = document.getElementById('promotionFilter');
    const companyFilter = document.getElementById('companyFilter');
    const offerTable = document.getElementById('offerTable').getElementsByTagName('tbody')[0];
    const offers = offerTable.getElementsByTagName('tr');

    // Fonction pour afficher ou masquer une offre en fonction des filtres sélectionnés
    function applyFilters() {
        const selectedContract = contractFilter.value.toLowerCase();
        const selectedDuration = durationFilter.value;
        const selectedPromotionId = promotionFilter.value;
        const selectedCompanyId = companyFilter.value;

        for (let i = 0; i < offers.length; i++) {
            const offerContract = offers[i].querySelector('[data-type]').getAttribute('data-type').toLowerCase();
            const offerDuration = calculateDuration(offers[i].querySelector('[data-starting-date]').innerText, offers[i].querySelector('[data-ending-date]').innerText);
            const offerPromotionId = offers[i].querySelector('[data-promotion]').getAttribute('data-promotion');
            const offerCompanyId = offers[i].querySelector('[data-company]').getAttribute('data-company');

            // Vérifier si l'offre passe tous les filtres sélectionnés
            const contractPass = selectedContract === 'all' || offerContract === selectedContract;
            const durationPass = selectedDuration === 'all' || offerDuration === selectedDuration;
            const promotionPass = selectedPromotionId === 'all' || offerPromotionId === selectedPromotionId;
            const companyPass = selectedCompanyId === 'all' || offerCompanyId === selectedCompanyId;

            // Afficher ou masquer l'offre en fonction du résultat des filtres
            if (contractPass && durationPass && promotionPass && companyPass) {
                offers[i].style.display = '';
            } else {
                offers[i].style.display = 'none';
            }
        }
    }

    // Écouter les changements dans tous les filtres
    contractFilter.addEventListener('change', applyFilters);
    durationFilter.addEventListener('change', applyFilters);
    promotionFilter.addEventListener('change', applyFilters);
    companyFilter.addEventListener('change', applyFilters);
});
</script>


@vite('resources/js/offer.js')
@vite('resources/js/postal.js')
@vite('resources/js/offer_filter.js')
@endsection
