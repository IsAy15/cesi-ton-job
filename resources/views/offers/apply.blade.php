@extends('layouts.home')
@section('title', 'Postuler à une offre')
@section('content')
    <h1>Postuler à l'offre "{{ $offer->title }}" de {{ $offer->company->name }}</h1>

    <form action="{{ route('offers.apply', $offer->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="cv">CV:</label><br>
        <input type="file" id="cv" name="cv"><br><br>

        <label for="letter">Lettre de motivation:</label><br>
        <input type="file" id="letter" name="letter"><br><br>
        
        <button type="submit">Postuler</button>
    </form>
@endsection
