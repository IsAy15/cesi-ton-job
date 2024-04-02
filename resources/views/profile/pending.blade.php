<!-- resources/views/pending.blade.php -->
@extends('layouts.home')
@section('title', 'Utilisateurs en attente')
@section('content')
    <div class="container-1 default-bg fit-center">
        <h1>Utilisateurs en attente</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Validation</th>
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
                        <!-- <a href="{{ route('profile.edit', $user->id) }}" class="btn-1"><i class="fa-solid fa-pen-to-square"></i>
                        </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@vite('resources/js/pending.js')
@endsection
