@extends('layouts.home')
@section('title', 'Offres obsolètes')
@section('content')
<div class="container-1 default-bg fit-center">
    <h2>Offres obsolètes et cachées</h2>
    @if ($offers->isNotEmpty())
        <div class="container-1 area-bg">
            @foreach($offers as $offer)
                <div class="offer">
                    <h3>{{ $offer->title }}</h3>
                    <p>{{ $offer->company->name }}</p>
                    <p>{{ $offer->description }}</p>
                    <p>Date de début : {{ $offer->starting_date }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>Aucune offre obsolète ou cachée n'est disponible pour le moment.</p>
    @endif
</div>
@endsection
