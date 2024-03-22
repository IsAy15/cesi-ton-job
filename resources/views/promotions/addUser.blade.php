@extends('layouts.home')
@section('title', 'Ajouter un utilisateur à une promotion')
@section('content')
    <div class="c-1 bg-1 fit-center">
        <h1>Ajouter un utilisateur à la promotion {{ $promotion->name }}</h1>
        <form action="{{ route('promotions.addUser', $promotion->id) }}" method="post">
            @csrf
            <label for="user">Utilisateur:</label>
            <select name="user" id="user">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                @endforeach
            </select>
            @error('user')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>  
@endsection
