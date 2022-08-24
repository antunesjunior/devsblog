@extends('layouts.auth')

@section('content')
    <h2>Editar Comentário</h2>

    @if (session('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="">Conteúdo</label><br>
            <textarea name="content" cols="30" rows="10">{{ $comment->content }}</textarea>

            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" value="confirmar">
    </form>

@endsection