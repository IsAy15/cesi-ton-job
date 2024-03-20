@extends('layouts.home')
@section('title', 'Détails de l\'offre')
@section('content')
    <h1>Détails de l'offre</h1>
    @auth
    @endauth
    <div>
        <p><strong>Titre :</strong> {{ $offer->title }}</p>
        <p><strong>Description :</strong> {{ $offer->description }}</p>
        <p><strong>Code postal :</strong> {{ $offer->localization }}</p>
        <p><strong>Ville :</strong> <span id="ville"></span></p> <!-- Ajout de l'élément span pour afficher la ville -->
        <p><strong>Date de début :</strong> {{ $offer->starting_date }}</p>
        <p><strong>Date de fin :</strong> {{ $offer->ending_date }}</p>
        <p><strong>Places disponibles :</strong> {{ $offer->places }}</p>
        <p><strong>Nombres de candidatures : </strong> {{ $offer->applies_count }}</p>
        <p><strong>Salaire :</strong> {{ $offer->salary }}</p>
        <p><strong>Type :</strong> {{ $offer->type }}</p>
        <p><strong>Entreprise :</strong> {{ $offer->company->name }}</p>
    </div>
    
    <!-- Bouton pour postuler à l'offre -->
    @auth
    @if (!$isApplied)
    <form action="{{ route('offers.apply', $offer->id) }}" method="POST">
    @csrf
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
