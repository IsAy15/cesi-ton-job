@extends('layouts.home')
@section('title', 'Détails de l\'utilisateur')

@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Détails de l'utilisateur</h1>

        <div>
    <img src="/uploads/avatars/{{ $user->avatar }}"style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
    <p><strong>Nom:</strong> {{ $user->lastname }}</p>
    <p><strong>Prénom:</strong> {{ $user->firstname }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Rôle:</strong> {{ $user->role }}</p>
    <p><strong>Niveau:</strong> 
    @foreach($user->userLevels as $userLevel)
        {{ $userLevel->level->title }}
        @if (!$loop->last)
            ,
        @endif
    @endforeach
</p>




    <p><strong>Promotions:</strong> 
        @forelse($user->promotions as $promotion)
            {{ $promotion->name }}
            @if (!$loop->last)
                ,
            @endif
        @empty
            Aucune promotion pour cet utilisateur
        @endforelse
    </p>
</div>


        <div>
            <h2>Offres auxquelles l'utilisateur a postulé :</h2>
            @if($user->offers->count() > 0)
                <ul>
                    @foreach($user->offers as $offer)
                        <li>{{ $offer->title }}</li>
                    @endforeach
                </ul>
            @else
                <p>L'utilisateur n'a pas encore postulé à des offres.</p>
            @endif
        </div>

        <div>
            <a href="{{ route('users.index') }}" class="btn-1">Retour à la liste des utilisateurs</a>
        </div>
    </div>
@endsection
