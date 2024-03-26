@extends('layouts.home')
@section('title', 'Ajouter une promotion')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Ajouter une promotion</h1>
        <form action="{{ route('promotions.store') }}" method="post" class="form-v">
            @csrf
            <div class="liste-v fit-center">
                <input type="text" name="name" id="name" placeholder="Nom">
            </div>
            <button type="submit" class="btn-1">Ajouter</button>
        </form>
    </div>
@endsection