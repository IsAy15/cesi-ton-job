@extends('layouts.home')
@section('title', 'Ajouter une entreprise')
@section('content')
@vite('resources/css/checkmark.css')

@if(Auth::user()->role != 'admin' && Auth::user()->role != 'pilote')
    <?php
        header('Location: /access-denied.php');
        exit();
    ?>
@endif
    <div class="container-1 default-bg fit-center">
        <h1>Ajouter une entreprise</h1>
        <form action="{{ route('companies.store') }}" method="post" class="form-v">
            @csrf
            <div>
                <input type="text" name="cp_name" id="cp_name" placeholder="Nom de l'entreprise">
            </div>
            <div>
                <input type="text" name="cp_localization" id="cp_localization" placeholder="Localisation">
            </div>
            <div>
                <select name="cp_sector" id="cp_sector">
                    <option value="" selected>Choisir un secteur</option>
                    <option value="Informatique">Informatique</option>
                    <option value="S3E">S3E</option>
                    <option value="Générale">Générale</option>
                    <option value="BTP">BTP</option>
                </select>
            </div>
            <div class="form-v">
                <label for="create_offer">Créer une offre après l'ajout de l'entreprise</label>
                <input type="checkbox" name="create_offer" id="create_offer">
            </div>
            <button type="submit" class="btn-1">Ajouter</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var sector = document.getElementById("cp_sector").value;
            var localization = document.getElementById("cp_localization").value;
            var sector = document.getElementById("cp_sector").value;

            if (name === "" || localization === "" || sector === "") {
                alert("Veuillez remplir tous les champs");
                return false;
            }
            return true;
        }
    </script>
@endsection
