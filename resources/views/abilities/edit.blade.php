@extends('layouts.home')
@section('title', 'Modifier une compétence')
@section('content')
    <form action="{{ route('abilities.update', $ability->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="ab_title">Titre</label>
            <input type="text" name="ab_title" id="ab_title" value="{{ $ability->title }}">
        </div>
        <div>
            <label for="ab_description">Description</label>
            <input type="text" name="ab_description" id="ab_description" value="{{ $ability->description }}">
        </div>
        <button type="submit">Modifier</button>
    </form>
@endsection