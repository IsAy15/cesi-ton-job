<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création des offres</title>
</head>
<body>
    <h1>Ajouter une offre</h1>
    <form action="{{ route('offers.store') }}" method="post">
        @csrf
        <div>
            <label for="of_title">Titre</label>
            <input type="text" name="of_title" id="of_title">
        </div>
        <div>
            <label for="of_description">Description</label>
            <input type="text" name="of_description" id="of_description">
        </div>
        <div>
            <label for="of_codepos">Code Postal</label>
            <input type="text" name="of_codepos" id="of_codepos">
            <span id="ville"></span> <!-- Place pour afficher la ville -->
        </div>
        
        <div>
            <label for="of_starting_date">Date de début</label>
            <input type="date" name="of_starting_date" id="of_starting_date">
        </div>
        <div>
            <label for="of_ending_date">Date de fin</label>
            <input type="date" name="of_ending_date" id="of_ending_date">
        </div>
        <div>
            <label for="of_places">Places disponibles</label>
            <input type="number" name="of_places" id="of_places">
        </div>
        <div>
            <label for="of_salary">Salaire</label>
            <input type="number" name="of_salary" id="of_salary">
        </div>
        <div>
            <label for="of_type">Type</label>
            <input type="text" name="of_type" id="of_type">
        </div>
        <div>
            <label for="of_company_id">Nom de l'entreprise</label>
            <select name="of_company_id" id="of_company_id">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Ajouter</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var codePostalInput = document.getElementById('of_codepos');
            var villeSpan = document.getElementById('ville');

            codePostalInput.addEventListener('blur', function() {
                var codePostal = codePostalInput.value.trim();

                var apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=' + codePostal;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.features && data.features.length > 0 && data.features[0].properties.city) {
                            villeSpan.textContent = data.features[0].properties.city;
                        } else {
                            villeSpan.textContent = 'Non disponible';
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        villeSpan.textContent = 'Erreur lors de la récupération';
                    });
            });
        });
    </script>
</body>
</html>
