@extends('layouts.auth')

@section('content')

    <h2>Descobrir Usuários</h2>

    @foreach ($users as $user)
        @can('follow', $user)
            <div style="border: 1px solid black; width:500px; padding:20px">
                <a href="{{ route('user.show', $user->username) }}">
                    <div style="width: 80px; height: 80px; border: 1px solid black">
                        <img style="width: 100%; height: 100%" 
                            src="{{ asset('storage/avatars/'.$user->picture) }}" alt="Profile Picture">
                    </div>

                    <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p>{{ $user->bio }}</p>
                    <p>Compainha: {{ $user->company }}</p>
                </a>

                <a href="{{ route('user.follow', $user->username) }}">Seguir</a> 
            </div><br>
        @endcan
    @endforeach
@endsection