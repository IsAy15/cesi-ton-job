<!-- resources/views/pending.blade.php -->
@extends('layouts.home')
@section('title', 'Utilisateurs en attente')

@section('content')
    <div class="container">
        <h1>Utilisateurs en attente</h1>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingUsers as $user)
                <tr>
                    <td>{{ $user->lastname }} {{ $user->firstname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn-1"><i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
