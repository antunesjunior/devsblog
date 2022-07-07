@extends('layouts.default')

@section('content')

<h2>Recuprar senha</h2>
<p>Por favor, digite a sua nova senha!</p>
<form action="{{ route('password.update') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <input type="email" name="email" placeholder="Email">
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