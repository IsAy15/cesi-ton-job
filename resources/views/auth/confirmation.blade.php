@extends('layouts.home')
@section('title', 'Confirmation')
@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            Votre inscription a été confirmée avec succès !
        </div>
        <a href="{{ route('auth.login') }}" class="btn-1">Retour</a>
    </div>
@endsection
