@extends('layouts.home')
@section('title', 'Ajouter une offre')
@section('content')
@vite('resources/css/offer.css')
@vite('resources/css/abilities.css')
    <div class="container-1 default-bg fit-center">
        <h1>Ajouter une offre</h1>
        <form action="{{ route('offers.store') }}" method="post" class="form-v">
            @csrf
                <select name="of_company_id" id="of_company_id">
                    <option value="" disabled @if(!$selected_company) selected @endif hidden>Entreprise</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" @if($selected_company == $company->id) selected @endif>{{ $company->name }}</option>
                    @endforeach
                    <option value="new">Ajouter une entreprise</option>
                </select>
                <input type="text" name="of_title" id="of_title" placeholder="Titre">
                <input type="text" name="of_type" id="of_type" placeholder="Type">
                <textarea type="text" name="of_description" id="of_description" placeholder="Description"></textarea>
                {{-- <input type="text" name="of_localization" id="of_localization" placeholder="Code postal"> --}}
                <select name="of_localization" id="of_localization">
                    <option value="" disabled selected hidden>Localisation</option>
                </select>

            <div class="liste-h space">
                <div class="input-required">
                    <label for="of_starting_date">Date de début</label>
                    <input type="date" name="of_starting_date" id="of_starting_date">
                </div>
                <div class="input-required">
                    <label for="of_ending_date">Date de fin</label>
                    <input type="date" name="of_ending_date" id="of_ending_date">
                </div>
            </div>
            <div>
                <label for="of_places">Places disponibles</label>
                <input type="number" name="of_places" id="of_places">
            </div>
            <div>
                <label for="of_salary">Salaire (/mois)</label>
                <input type="number" name="of_salary" id="of_salary">
            </div>
            <div>
                <select name="of_promotion_id" id="of_promotion_id">
                    <option value="" disabled selected hidden>Promotion</option>
                    @foreach($promotions as $promotion)
                        <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="of_level_id" id="of_level_id">
                    <option value="" disabled selected hidden>Niveau requis</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="fit-center form-v">
                <label>Compétences requises : </label>
                <div class="abilities-select area-bg">
                    <div class="container">
                        <input id="searchInput" list="abilities">
                        <div id="selectedAbilities"></div>
                    </div>
                    <datalist id="abilities">
                        @foreach($abilities->sortBy('title') as $ability)
                            <option ability_id="{{ $ability->id }}" value="{{ $ability->title }}"></option>
                        @endforeach
                    </datalist>
                    <input type="hidden" id="selectedAbilitiesInput" name="of_abilities">
                </div>
                <a href="{{ route('abilities.create') }}" class="btn-1 btn-2" >Créer une nouvelle compétence &nbsp;<i class="fa-solid fa-plus"></i></a>
            </div>
            <button type="submit" class="btn-1">Ajouter</button>
        </form>
    </div>
    <script>
        const selectElement = document.querySelector('#of_company_id');
        selectElement.addEventListener('change', (event) => {
            if (event.target.value == 'new') {
                window.location.href = '{{ route("companies.create") }}?offer';
            }
        });
    </script>
@endsection
@vite('resources/js/add_offer_abilities.js')
@vite('resources/js/offer_localization.js')
