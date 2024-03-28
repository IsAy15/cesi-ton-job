@extends('layouts.home')
@section('title', 'Liste des compétences')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Liste des compétences</h1>
        <a href="{{ route('abilities.create') }}" class="btn-1 btn-2"><i class="fa-solid fa-plus"></i></a>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abilities as $ability)
                    <tr>
                        <td>{{ $ability->title }}</td>
                        <td>{{ $ability->description }}</td>
                        <td>
                            <div class="space">
                                <a href="{{ route('abilities.edit', $ability->id) }}" class="btn-1 btn-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('abilities.destroy', $ability->id) }}" method="post">
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