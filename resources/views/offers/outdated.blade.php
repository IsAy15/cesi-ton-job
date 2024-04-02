@extends('layouts.home')
@section('title', 'Offres obsolètes')
@section('content')
<div class="container-1 default-bg fit-center">
    <h1>Offres obsolètes et cachées</h1>
    @if ($offers->isNotEmpty())
        @foreach($offers as $offer)
            <div class="container-1 area-bg">
                <h2>{{ $offer->title }}</h2>
                <p>{{ $offer->description }}</p>
                <div class="space">
                    <p>{{ $offer->company->name }}</p>
                    @php
                        $origin = new DateTimeImmutable($offer->starting_date);
                        $duration = $origin->diff(new DateTimeImmutable($offer->ending_date));
                    @endphp
                    <p start>Début : {{ $origin->format('d/m/Y') }}</p>
                    <p duration="{{ $duration->format("%a") }}">Durée : {{ $duration->format('%a jours') }}</p>
                </div>
                <div class="liste-h">
                    <a href="{{ route('offers.show', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-eye"></i></a>
                    @if(Auth::user()->role=="admin" || Auth::user()->role=="pilote")
                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>Aucune offre obsolète ou cachée n'est disponible pour le moment.</p>
    @endif
</div>
@endsection
