@extends('layouts.auth')

@section('content')

<h2><span style="color: green">{{ $comment->content }}</span></h2>

<div>
    <a href="{{ route('comments.replies.create', $comment->id) }}">
        Adicionar comentário
    </a>
</div><br>

<div>
    @foreach ($replies as $reply)
        <article style="border: 1px solid black; padding:0 5px; margin-bottom:8px">
            <h3>{{ $reply->user->first_name }} {{ $reply->user->last_name }}</h3>
            <p>
                {{ $reply->content }}
            </p>
            <hr>
            <p>
                <small>{{ $reply->created_at }}</small>&nbsp;|
                <small>{{ $reply->updated_at }}</small>
                @can('update', $reply)
                    <small><a href="{{ route('comments.edit', $reply->id) }}">Editar</a></small>
        
                    <form method="POST" action="{{ route('comments.destroy', $reply->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Apagar">
                    </form>
                @endcan
            </p>
        </article>
    @endforeach
</div>

@endsection