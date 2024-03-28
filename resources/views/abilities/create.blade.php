@extends('layouts.home')
@section('title', 'Ajouter une compétence')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Ajouter une compétence</h1>
        <form action="{{ route('abilities.store') }}" method="post" class="form-v">
            @csrf
            <div class="input-required fit-center">
                <label for="ab_title">Titre</label>
                <input type="text" name="ab_title" id="ab_title" placeholder="Titre">
            </div>
            <div class="input-required fit-center">
                <label for="ab_description">Description</label>
                <input type="text" name="ab_description" id="ab_description" placeholder="Description">
            </div>
            <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></button>
        </form>
    </div>
@endsection