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

@can('update', $user)
    <div>
        <a href="{{ route('user.edit') }}">Editar perfil</a>
    </div>
@endcan

<br><br>

@can('update', $user)
    <h2>Meus artigos</h2>
@else
    <h2>Artigos de {{ $user->first_name }}</h2>
@endcan

<hr>

<div>
    <a href="{{ route('posts.published', $user->id) }}">Publicados</a> 
    @can('viewDrafts', $user)
       | <a href="{{ route('posts.draft', $user->id) }}">Rascunhos</a>
    @endcan
</div>

@endsection