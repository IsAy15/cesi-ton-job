@extends('layouts.home')
@section('title', 'Modifier la promotion')
@section('content')
    <h1>Modifier la promotion</h1>
    <form action="{{ route('promotions.update', $promotion->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" value="{{ $promotion->name }}">
        </div>
        <button type="submit">Modifier</button>
    </form>
@endsection