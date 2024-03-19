@extends('layouts.home')
@section('title', 'Ajouter une promotion')
@section('content')
    <h1>Ajouter une promotion</h1>
    <form action="{{ route('promotions.store') }}" method="post">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name">
        </div>
        <button type="submit">Ajouter</button>
    </form>
@endsection