<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les offres</title>
</head>
<body>
    <h1>Offres d'emploi</h1>
    <input type="text" id="searchInput" placeholder="Rechercher une offre...">
    <a href="{{ route('offers.create') }}">Ajouter une offre</a>
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
                        <a href="{{ route('offers.apply', $offer->id) }}" class="btn btn-primary">Postuler</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function filterOffers() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("offerTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""; 
                    } else {
                        tr[i].style.display = "none"; 
                    }
                }       
            }
        }

        // Appeler la fonction de filtrage lorsque l'utilisateur tape quelque chose dans la barre de recherche
        document.getElementById("searchInput").addEventListener("keyup", filterOffers);

        // Ajouter un événement de clic à chaque titre d'offre pour afficher les détails de l'offre
        var offerTitles = document.querySelectorAll('#offerTable tbody tr td:first-child a');
        offerTitles.forEach(function(offerTitle) {
            offerTitle.addEventListener('click', function(event) {
                event.preventDefault();
                var offerUrl = offerTitle.getAttribute('href');
                window.location.href = offerUrl;
            });
        });
    </script>
</body>
</html>
