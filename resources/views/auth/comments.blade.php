@extends('layouts.auth')

@section('content')

<h2>Comentarios do post: <span style="color: green">{{ $title }}</span></h2>
<div>
    @foreach ($comments as $comment)
        <article style="border: 1px solid black; padding:0 5px">
            <h3>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</h3>
            <p>
                {{ $comment->content }}
            </p>
            <hr>
            <p>
                <small>{{ $comment->created_at }}</small>&nbsp;|
                <small>{{ $comment->updated_at }}</small>
            </p>
        </article>
    @endforeach
</div>

@endsection