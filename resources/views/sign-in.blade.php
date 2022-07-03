@extends('layouts.default')

@section('content')

<h2>Entrar</h2>

@if (session('alert'))
    <p>{{ session('alert') }}</p>
@endif

<form action="{{ route('auth') }}" method="post">
    @csrf
    <div class="form-group">
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    </div>
    @error('email')
        <p>{{ $message }}</p>
    @enderror

    <div class="form-group">
        <input type="password" name="password" placeholder="Password" value="{{ old('password') }}">
    </div>

    @error('password')
        <p>{{ $message }}</p>
    @enderror

    <div class="form-group">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Savar dados?</label>
    </div>
    <input type="submit" value="cadastrar">

</form>

@endsection