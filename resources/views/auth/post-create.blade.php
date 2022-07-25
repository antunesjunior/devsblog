@extends('layouts.auth')

@section('content')
    <h2>Criar Post</h2>

    @if (session('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

    <form action="{{ route('posts.store') }}" method="Post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">Titulo</label><br>
            <input type="text" name="title">
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div><br>
        <div>
            <label for="">Descrição</label><br>
            <input type="text" name="description">
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
            <textarea name="content" cols="30" rows="10"></textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" name="draft" value="guaradar rascunho"">
        <input type="submit" value="Publicar agora">
    </form>

@endsection