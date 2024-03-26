@extends('layouts.home')
@section('title', 'Vos offres')
@section('content')
@vite('resources/css/brouillon-generale.css')
    <div class="c-1 bg-1 fit-center">
        <h2>Vos offres</h2>
        <div class="form-v">
            @if ($appliedOffers)
                @foreach($appliedOffers as $offer)
                    <div class="c-1 bg-2">
                        <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                    </div>
                @endforeach
            @else
                <p>Vous n'avez pas encore candidaté à des offres.</p>
            @endif
        </div>
    </div>
@endsection
