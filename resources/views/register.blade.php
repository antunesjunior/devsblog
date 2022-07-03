@extends('layouts.default')

@section('content')

<h2>Criar Conta</h2>

<form enctype="multipart/form-data" action="{{ route('create.user') }}" method="post">
    @csrf
    <div class="form-group">
        <input type="text" name="first_name" placeholder="Primeiro nome">
        @error('first_name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <input type="text" name="last_name" placeholder="Ultimo nome">
        @error('last_name')
            <p>{{ $message }}</p>
        @enderror
    </div><br>

    <div class="form-group">
        <input type="email" name="email" placeholder="Email">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div><br>

    <div class="form-group">
        <input type="password" name="password" placeholder="Password"><br>
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <input type="password" name="password_confirmation" placeholder="confirmar Password">
        @error('password_confirmation')
            <p>{{ $message }}</p>
        @enderror
    </div><br>

    <input type="submit" value="cadastrar">
</form>

@endsection