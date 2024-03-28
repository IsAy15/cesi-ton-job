@extends('layouts.home')
@section('title', 'Modifier une compétence')
@section('content')
    <div class="container-1 default-bg fit-center">
        <form action="{{ route('abilities.update', $ability->id) }}" method="post" class="form-v">
            @csrf
            @method('PUT')
            <div class="input-required fit-center">
                <label for="ab_title">Titre</label>
                <input type="text" name="ab_title" id="ab_title" value="{{ $ability->title }}" placeholder="Titre">
            </div>
            <div class="input-required fit-center">
                <label for="ab_description">Description</label>
                <input type="text" name="ab_description" id="ab_description" value="{{ $ability->description }}" placeholder="Description">
            </div>
            <div class="liste-h fit-center">
                <a href="{{ route('abilities.index') }}" class="btn-1 btn-2"><i class="fa-solid fa-arrow-left"></i></a>
                <a href="{{ route('abilities.edit', $ability->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-xmark"></i></a>
                <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-check"></i></button>
        </form>
    </div>
@endsection