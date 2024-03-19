<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Vos offres</div>

                    <div class="card-body">
                        @if ($appliedOffers->isEmpty())
                            <p>Vos offres :</p>
                        @else
                            <ul>
                                @foreach($appliedOffers as $offer)
                                    <li>
                                    <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>