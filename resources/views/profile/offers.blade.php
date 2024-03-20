@extends('layouts.home')
@section('title', 'Vos offres')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vos offres</div>

                <div class="card-body">
                    @if ($appliedOffers)
                        <ul>
                            @foreach($appliedOffers as $offer)
                                <li>
                                    <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Vous n'avez pas encore candidaté à des offres.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
