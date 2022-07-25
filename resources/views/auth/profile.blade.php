@extends('layouts.auth')

@section('content')

<h2>Perfil</h2>

<div style="width: 200px; height: 200px; border: 1px solid black">
    <img style="width: 100%; height: 100%" 
        src="{{ asset('storage/avatars/'.$user->picture) }}" alt="Profile Picture">
</div>

<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
<p><strong>Site: </strong><a href="{{ $user->web }}">{{ $user->web }}</a></p>
<p><strong>Companhia: </strong>{{ $user->company }}</p>
<p><strong>Cidadde: </strong>{{ $user->city }}</p>

@if ($user->bio)
    <div>
        <p>
            <strong>Biografia:</strong>
            <i>{{ $user->bio}}</i>
        </p>
    </div>
@endif

<div><a href="{{ route('profile.edit') }}">Editar perfil</a></div>
<br><br>

<h2>Meus artigos</h2>
<hr>

<div>
    <a href="{{ route('posts.list', 'posted') }}">Publicados</a> |
    <a href="{{ route('posts.list', 'draft') }}">Rascunhos</a>
</div>

@endsection