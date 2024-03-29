@extends('layouts.home')
@section('title', 'Ajouter des compétences')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter des compétences</div>

                <div class="card-body">
                    @if ($allabilities->isEmpty())
                        <div class="alert alert-info" role="alert">
                            Aucune compétence à ajouter pour le moment.
                        </div>
                    @else
                        <form method="POST" action="{{ route('profile.store') }}">
                            @csrf

                            <div>
                                <label for="abilities">Compétences</label>

                                <div>
                                    <select id="abilities" name="abilities[]" class="form-control" multiple>
                                        @foreach($allabilities as $ability)
                                            <option value="{{ $ability->id }}">{{ $ability->title }}</option>
                                        @endforeach
                                    </select>

                                    @error('abilities')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    @endif
                    <div>
                        <a href="{{ route('profile.index') }}" class="btn-1 btn-2"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
