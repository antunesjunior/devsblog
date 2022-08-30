@extends('layouts.auth')

@section('content')

<h2>{{ $title }}</h2>

@foreach ($posts as $post)
    <div style="display: flex; border:1px solid black; margin-top:10px; width:800px">
        <div style="width: 100px; height: 100px; border: 1px solid black">
            <img style="width: 100%; height: 100%" 
                src="{{ asset('storage/posts/covers/'.$post->cover) }}" alt="Profile Picture">
        </div>
        <div style="padding-left: 10px">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->description }}</p>
            <p>
                <small>
                    Autor: 
                    <a href="{{ route('user.show', $post->user->username) }}">
                        {{ $post->user->first_name }} {{ $post->user->last_name }}
                    </a>
                </small>
            </p>
            <p>
                <a href="{{ route('posts.show', $post->uri) }}">Ver Artigo</a>
                <a href="{{ route('posts.like', $post->uri) }}">
                    {{ $post->like()->count() }}.Like
                </a>
                <a href="{{ route('posts.comments.index', $post->uri) }}">
                    {{ $post->comments()->count() }}.comentarios
                </a>
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post->id) }}">Actualizar</a>
                    <a href="{{ route('posts.destroy', $post->id) }}">Eliminar</a>
                @endcan
            </p>
        </div>
    </div>
@endforeach

@endsection