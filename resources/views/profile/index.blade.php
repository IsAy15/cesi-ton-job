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
                    <div class="card-header">Votre profil</div>

                    <div class="card-body">
                        <div>
                            <p><strong>Nom de famille:</strong> {{ $user->lastname }}</p>
                            <p><strong>Prénom:</strong> {{ $user->firstname }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Rôle:</strong> {{ $user->role }}</p>
                        </div>

                        @if($user->promotions->isNotEmpty())
                            <div>
                                <h4>Promotion:</h4>
                                <ul>
                                    @foreach($user->promotions as $promotion)
                                        <li>{{ $promotion->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p>Aucune promotion n'est associée à cet utilisateur.</p>
                        @endif
                        <div>
                            <a href="{{ route('profile.offers') }}" class="btn btn-primary">Voir les offres postulées</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>