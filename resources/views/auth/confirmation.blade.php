@extends('layouts.home')
@section('title', 'Confirmation')
@section('content')
    <div class="container-1 default-bg fit-center">
        Votre inscription a été confirmée avec succès !
        <a href="{{ route('auth.login') }}" class="btn-1">Retour</a>
    </div>
@endsection
