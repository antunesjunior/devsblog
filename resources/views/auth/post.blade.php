@extends('layouts.auth')

@section('content')

<h2>{{ $post->title }}</h2>

<div style="width: 600px; height: 300px; border: 1px solid black">
    <img style="width: 100%; height: 100%" 
        src="{{ asset('storage/posts/covers/'.$post->cover) }}" alt="Profile Picture">
</div>

<p><i><strong>{{ $post->description }}</strong></i></p>

<p>{{ $post->content }}</p>


@endsection