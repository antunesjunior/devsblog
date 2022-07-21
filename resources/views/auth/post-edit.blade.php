@extends('layouts.auth')

@section('content')
    <h2>Criar Post</h2>

    @if (session('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="">Titulo</label><br>
            <input type="text" name="title" value="{{ $post->title }}">
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div><br>
        <div>
            <label for="">Descrição</label><br>
            <input type="text" name="description" value="{{ $post->description }}">
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div><br>

        <div>
            <label for="">Capa do Post</label><br>
            <input type="file" name="cover">
            @error('cover')
                <p>{{ $message }}</p>
            @enderror
        </div><br>

        <div>
            <label for="">Conteúdo</label><br>
            <textarea name="content" cols="30" rows="10">{{ $post->content }}</textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" value="guaradar rascunho">
    </form>

@endsection