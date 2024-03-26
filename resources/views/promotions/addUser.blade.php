@extends('layouts.home')
@section('title', 'Ajouter un utilisateur à une promotion')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h2>Ajouter un utilisateur à la promotion {{ $promotion->name }}</h2>
        <form action="{{ route('promotions.addUser', $promotion->id) }}" method="post" class="form-v">
            @csrf
            <select name="user" id="user">
                    <option value="" disabled selected>Utilisateur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                @endforeach
            </select>
            @error('user')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn-1">Ajouter</button>
        </form>
    </div>  
@endsection
