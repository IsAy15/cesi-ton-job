<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Vos offres</div>
                    <div class="card-body">
                        @if ($wishlist->count() === 0)
                            <p>Votre wishlist est vide.</p>
                        @else
                            <ul>
                                @foreach($wishlist as $offer)
                                    <li>
                                        <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->title }}</a>
                                        @auth
                                        <form action="{{ route('wishlist.remove', $offer->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer de la wishlist</button>
</form>

                                        @endauth
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
