<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les offres</title>
</head>
<body>
    <h1>Offres d'emploi</h1>
    <a href="{{ route('offers.create') }}">Ajouter une offre</a>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Places disponibles</th>
                <th>Salaire</th>
                <th>Type</th>
                <th>Entreprise</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
                <tr>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->description }}</td>
                    <td class="code-postal">{{ $offer->localization }}</td>
                    <td class="ville"></td> 
                    <td>{{ $offer->starting_date }}</td>
                    <td>{{ $offer->ending_date }}</td>
                    <td>{{ $offer->places }}</td>
                    <td>{{ $offer->salary }}</td>
                    <td>{{ $offer->type }}</td>
                    <td>{{ $offer->company->name }}</td>
                    <td>
                        <a href="{{ route('offers.edit', $offer->id) }}">Modifier</a>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                        <a href="{{ route('offers.apply', $offer->id) }}" class="btn btn-primary">Postuler</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var codePostalElements = document.querySelectorAll('.code-postal');
            codePostalElements.forEach(function(element) {
                var codePostal = element.textContent.trim();
                var villeElement = element.nextElementSibling;

                var apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=' + codePostal;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.features && data.features.length > 0 && data.features[0].properties.city) {
                            villeElement.textContent = data.features[0].properties.city;
                        } else {
                            villeElement.textContent = 'Non disponible';
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        villeElement.textContent = 'Erreur lors de la récupération';
                    });
            });
        });
    </script>
</body>
</html>
