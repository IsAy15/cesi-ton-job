@extends('layouts.home')
@section('title', 'Vos offres')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h2>Vos offres</h2>
        <div class="form-v">
            @if ($appliedOffers)
                @foreach($appliedOffers as $offer)
                    <div class="container-1 area-bg">
                        <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                    </div>
                @endforeach
            @else
                <p>Vous n'avez pas encore candidaté à des offres.</p>
            @endif
        </div>
    </div>
@endsection
