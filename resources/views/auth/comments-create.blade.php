@extends('layouts.auth')

@section('content')
    <h2>Criar Comentário</h2>

    @if (session('message'))
        <p>{{ session()->get('message') }}</p>
    @endif

    <form action="{{ route('posts.comments.store', $slag) }}" 
        method="Post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">Conteúdo</label><br>
            <textarea name="content" cols="30" rows="10"></textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" value="confirmar">
    </form>

@endsection