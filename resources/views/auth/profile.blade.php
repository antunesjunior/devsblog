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

<h2>Meus artigos publicados</h2>
<hr>

@foreach ($posts as $post)
    <div style="border: 1px solid orange; padding:10px; margin-bottom:5px">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->description }}</p>
        <a href="{{ route('posts.show', $post->id) }}">Ver</a> |
        <a href="{{ route('posts.edit', $post->id) }}">Editar</a> |
        <a href="{{ route('posts.destroy', $post->id) }}">Eliminar</a>
    </div>
@endforeach

@endsection