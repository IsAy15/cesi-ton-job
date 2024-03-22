@extends('layouts.home')
@section('title', 'Offres d\'emploi')
@section('content')
@vite('resources/css/offer.css')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h1>Offres d'emploi</h1>
        <input type="text" id="searchInput" placeholder="Search...">
        <a href="{{ route('offers.create') }}" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></a>
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
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->localization }}</td>
                        <td></td> 
                        <td>{{ $offer->starting_date }}</td>
                        <td>{{ $offer->ending_date }}</td>
                        <td>{{ $offer->type }}</td>
                        <td>{{ $offer->company->name }}</td>
                        <td class="table-interactions">
                            <a href="{{ route('offers.show', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
@endsection