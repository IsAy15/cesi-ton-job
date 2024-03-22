@extends('layouts.home')
@section('title', 'Liste des promotions')
@section('content')
@vite('resources/css/brouillon-generale.css')
<div class="c-1 bg-1 fit-center">
    <h1>Liste des promotions</h1>
       <a href="{{ route('promotions.create') }}" class="btn-1">Ajouter une promotion</a>
        <table class="">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promotion)
                    <tr>
                        <td>{{ $promotion->name }}</td>
                        <td>
                            <div class="table-interactions">
                                <a href="{{ route('promotions.addUser', $promotion->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-user-plus"></i></a>
                                <a href="{{ route('promotions.users', $promotion->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('promotions.destroy', $promotion->id) }}" method="post"  class="form-v">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-1 btn-2"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
