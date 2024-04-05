<!-- resources/views/pending.blade.php -->
@extends('layouts.home')
@section('title', 'Utilisateurs en attente')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Utilisateurs en attente</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Validation</th>
                    <th>Refus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingUsers as $user)
                <tr>
                    <td><a href="{{ route('users.show', ['id' => $user->id]) }}" class="clickable">{{ $user->lastname }}</a>{{ $user->firstname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" id="{{ $user->id }}">
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-1 btn-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><i class="fa-solid fa-trash"></i></button>
                    </form>                    
                    </td>

                        
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@vite('resources/js/pending.js')
@endsection
