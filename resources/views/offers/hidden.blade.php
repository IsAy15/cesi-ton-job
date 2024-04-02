@extends('layouts.home')
@section('title', 'Offres cachées')
@section('content')
@vite('resources/css/offer.css')
<div class="container-1 default-bg fit-center">
    <div class="input-required fit-center">
        <h1>Offres cachées</h1>
        <div class="form-v offers-container">
            @foreach($hiddenOffers as $offer)
            <div class="container-2 area-bg fit-center">
                <h2><a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a></h2>
                <div class="liste-h">
                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('offers.destroy', $offer->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    <form action="{{ route('offers.active', $offer->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
