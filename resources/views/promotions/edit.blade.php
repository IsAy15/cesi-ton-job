@extends('layouts.home')
@section('title', 'Modifier la promotion')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Modifier la promotion</h1>
        <form action="{{ route('promotions.update', $promotion->id) }}" method="post" class="form-v">
            @csrf
            @method('PUT')
            <div class="liste-v fit-center">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" value="{{ $promotion->name }}">
            </div>
            <button type="submit" class="btn-1">Modifier</button>
        </form>
    </div>
@endsection