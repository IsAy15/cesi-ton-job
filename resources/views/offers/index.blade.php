@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
    <div class="container-1 default-bg fit-center">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="input-required fit-center">
            <h1>Offres d'emploi</h1>
            <form>
                <div class="liste-h search-bar">
                    <input type="text" id="keywordInput" placeholder="Mot-clés" class="">
                    <h2>|</h2>
                    <input type="text" id="locationInput" placeholder="Localisation" list="communes" class="input-search-bar">
                    <datalist id="communes">
                    </datalist>
                    <input type="hidden" id="selectedCommuneInput" name="selectedCommune">
                    <a href="#" id="searchButton" class="btn-1 btn-2"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <a href="#" id="filterButton" class="btn-1 btn-2"><i class="fa-solid fa-filter"></i></a>
                </div>
            </form>
            <div class="filters" style="display: none;">
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
                    <option value="{{ $promotion->id }}" @if(auth()->user()->role == "user" && $promotion->id == auth()->user()->promotions[0]->id) selected @endif
                        >{{ $promotion->name }}</option>
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
    <div class="liste-h">
        <a href="{{ route('offers.stats') }}" class="btn-1 btn-2">Afficher les statistiques&nbsp;<i class="fa-solid fa-chart-simple"></i></a>
        @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
        <a href="{{ route('offers.create') }}" class="btn-1 btn-2">Ajouter une offre&nbsp;<i class="fa-solid fa-plus"></i></a>
        <a href="{{ route('offers.hidden') }}" class="btn-1 btn-2">Afficher les offres cachées&nbsp;<i class="fa-solid fa-eye-slash"></i></a>
        <a href="{{ route('offers.outdated') }}" class="btn-1 btn-2">Afficher les offres obsolètes&nbsp;<i class="fa-solid fa-calendar-times"></i></a>
        @endif
    </div>
    <div class="form-v offers-container">
        @foreach ($offers as $offer)
            <div offer="{{ $offer->id }}" class="container-2 area-bg">
                <h2><a title href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></h2>
                <div class="space">
                    <p contract>{{ $offer->type }}</p>
                    <p promo="{{ $offer->promotion->id }}">{{ $offer->promotion->name }}</p>
                </div>
                <div class="space">
                    @php
                        $origin = new DateTimeImmutable($offer->starting_date);
                        $duration = $origin->diff(new DateTimeImmutable($offer->ending_date));
                    @endphp
                    <p start>Début : {{ $origin->format('d/m/Y') }}</p>
                    <p duration="{{ $duration->format("%a") }}">Durée : {{ $duration->format('%a jours') }}</p>
                </div>
                <div class="space">
                    <p company="{{ $offer->company->id}}">{{ $offer->company->name }}</p>
                    <div>
                        @php
                            $offer->localization = json_decode($offer->localization);
                        @endphp
                        <p dep="{{ $offer->localization->dep }}">{{ $offer->localization->nom }} ({{ $offer->localization->cp }})</p>
                    </div>
                </div>
                @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
                    <div class="liste-h">
                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <form action="{{ route('offers.hide', $offer->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-eye-slash"></i></button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Partie 1: Fonction pour la recherche
    const searchButton = document.getElementById('searchButton');
    searchButton.addEventListener('click', function(event) {
        event.preventDefault(); 

        const keywordInput = document.getElementById('keywordInput').value.toLowerCase();
        const locationInput = document.getElementById('locationInput').value.toLowerCase();

        const offers = document.querySelectorAll('.offers-container .container-2');

        offers.forEach(function(offer) {
            const title = offer.querySelector('h2 a').textContent.toLowerCase();
            const location = offer.querySelector('div:nth-child(3) div p:last-child').textContent.toLowerCase();

            if (title.includes(keywordInput) && location.includes(locationInput)) {
                offer.style.display = 'block';
            } else {
                offer.style.display = 'none';
            }
        });
    });

    // Partie 2: Fonction pour afficher ou masquer les filtres
    const filterButton = document.getElementById("filterButton");
    const filters = document.querySelector(".filters");

    function toggleFilters() {
        if (filters.style.display === "none" || filters.style.display === "") {
            filters.style.display = "block";
        } else {
            filters.style.display = "none";
        }
    }

    filterButton.addEventListener("click", toggleFilters);

    // Partie 3: Fonction pour appliquer les filtres
    const contractFilter = document.getElementById('contractFilter');
    const durationFilter = document.getElementById('durationFilter');
    const promotionFilter = document.getElementById('promotionFilter');
    const companyFilter = document.getElementById('companyFilter');
    const offerTable = document.querySelector('.offers-container');
    const offers = offerTable.querySelectorAll("[offer]");
    const keywordInput = document.getElementById('keywordInput');
    const locationInput = document.getElementById('locationInput');

    function calculateDuration(duration) {
        if (duration <= 90) {
            return 'short';
        } else if (duration <= 180) {
            return 'medium';
        } else if (duration <= 365) {
            return 'long';
        } else {
            return 'very_long';
        }
    }

    function applyFilters() {
        const selectedContract = contractFilter.value.toLowerCase();
        const selectedDuration = durationFilter.value;
        const selectedPromotionId = promotionFilter.value;
        const selectedCompanyId = companyFilter.value;
        const keyword = keywordInput.value.toLowerCase();
        const location = locationInput.value.toLowerCase();

        for (let offer of offers) {
            let offerPromotion = offer.querySelector('[promo]').getAttribute('promo');
            let offerCompany = offer.querySelector('[company]').getAttribute('company');
            let offerContract = offer.querySelector('[contract]').textContent.toLowerCase();
            let offerDuration = calculateDuration(parseInt(offer.querySelector('[duration]').getAttribute('duration')));
            let offerTitle = offer.querySelector('[title]').textContent.toLowerCase();
            let offerPostalCode = offer.querySelector('[cp]').textContent;
            let offerCity = offer.querySelector('[city]').textContent.toLowerCase();

            let contractPass = selectedContract === 'all' || offerContract === selectedContract;
            let durationPass = selectedDuration === 'all' || offerDuration === selectedDuration;
            let promotionPass = selectedPromotionId === 'all' || offerPromotion === selectedPromotionId;
            let companyPass = selectedCompanyId === 'all' || offerCompany === selectedCompanyId;
            let keywordPass = keyword === '' || offerTitle.includes(keyword);
            let locationPass = location === '' || offerPostalCode.includes(location) || offerCity.includes(location);

            if (contractPass && durationPass && promotionPass && companyPass && keywordPass && locationPass) {
                offer.style.display = '';
            } else {
                offer.style.display = 'none';
            }
        }
    }

    // Écouter les changements dans tous les filtres et la recherche
    contractFilter.addEventListener('change', applyFilters);
    durationFilter.addEventListener('change', applyFilters);
    promotionFilter.addEventListener('change', applyFilters);
    companyFilter.addEventListener('change', applyFilters);
    keywordInput.addEventListener('input', applyFilters);
    locationInput.addEventListener('input', applyFilters);

    // Appliquer les filtres une fois que la page est chargée
    applyFilters();
});


            </script>
@vite('resources/js/offer.js')
@endsection
