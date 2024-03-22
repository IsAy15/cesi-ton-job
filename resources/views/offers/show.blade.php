@extends('layouts.home')
@section('title', 'Détails de l\'offre')
@section('content')
@vite('resources/css/offer.css')
@vite('resources/css/brouillon-generale.css')
@vite('resources/css/offre-brouillon.css')
    <div class="c-1 bg-1 fit-center">
        <h1>{{ $offer->title }}</h1>
        @auth
        @endauth
        <div class="liste-v">
            <h2>{{ $offer->company->name }}</h2>
            <p>Type de contrat: {{ $offer->type }}</p>
            <p>{{ $offer->description }}</p>
            <p>Ville : <span id="ville"></span> {{ $offer->localization }}</p> <!-- Ajout de l'élément span pour afficher la ville -->
            <div class="space">
                <p>Date de début : {{ $offer->starting_date }}</p>
                <p>Date de fin : {{ $offer->ending_date }}</p>
            </div>
            <p>Places disponibles : {{ $offer->places }}</p>
            <p>Nombres de candidatures : {{ $offer->applies_count }}</p>
            <div class="end-item">
                <p>Salaire : {{ $offer->salary }}</p>
            </div>
        </div>
        @auth
            @if (!$isApplied)
                <form id="application" action="{{ route('offers.apply', $offer->id) }}" method="POST" class="form-v">
                    @csrf
                    @csrf
                    <div class="form-v">
                        <label for="cv">CV:</label><br>
                        <input type="file" id="cv" name="cv"><br><br>
                    </div>
                    <label for="letter">Lettre de motivation:</label><br>
                    <input type="file" id="letter" name="letter"><br><br>
                    
                    <button type="submit" class="btn btn-primary">Postuler</button>
                </form>

            @else
                <p>Vous avez déjà postulé à cette offre.</p>
            @endif
            @if ($isInWishlist)
                <form action="{{ route('wishlist.remove', $offer->id) }}" method="post">
                @csrf
                @method('DELETE') <!-- Ajout de la méthode DELETE -->
                        <button type="submit">Supprimer de la wishlist</button>
                </form>
            @else
                <form action="{{ route('wishlist.add', $offer->id) }}" method="post">
                    @csrf
                    <button type="submit">Ajouter à la wishlist</button>
                </form>
            @endif
        @endauth

        <a href="{{ route('offers.index') }}">Retour à la page précédente</a>
    </div>

    <script>
        var postalCode = "{{ $offer->localization }}";

        fetch('https://api-adresse.data.gouv.fr/search/?q=' + postalCode)
            .then(response => response.json())
            .then(data => {
                if (data.features.length > 0) {
                    var city = data.features[0].properties.city;
                    document.getElementById('ville').textContent = city;
                }
            })
            .catch(error => console.error('Erreur lors de la récupération de la ville :', error));

            
    </script>
@endsection
