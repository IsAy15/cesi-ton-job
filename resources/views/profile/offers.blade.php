@extends('layouts.home')
@section('title', 'Vos offres')
@section('content')
<div class="container-1 default-bg fit-center">
    <h2>Vos offres</h2>
    <div class="form-v">
        @isset($createdOffers)
            @if ($createdOffers->isNotEmpty())
            <h3>Offres créées par vous :</h3>
            <div class="container-1 area-bg">
                @foreach($createdOffers as $offer)
                <a href="{{ route('offers.show', $offer->id) }}" class="clickable">{{ $offer->title }}</a>
                <p>{{ $offer->company->name }}</p>
                @endforeach
            </div>
            @else
            <p>Vous n'avez pas encore créé d'offres.</p>
            @endif
        @endisset

        @if($user->role !=='pilote' )
        @if ($appliedOffers->isNotEmpty())
        <h3>Offres auxquelles vous avez postulé :</h3>
        <div class="container-1 area-bg">
            @foreach($appliedOffers as $offer)
            <a href="{{ route('offers.show', $offer->id) }}" class="clickable">{{ $offer->title }}</a>
            <p>{{ $offer->company->name }}</p>
            @endforeach
        </div>
        @else
        <p>Vous n'avez pas encore postulé à des offres.</p>
        @endif
        @endif
    </div>
</div>
@endsection
