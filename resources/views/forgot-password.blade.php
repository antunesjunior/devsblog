@extends('layouts.default')

@section('content')
    <h2>Recupearação de senha</h2>
    <p>Digite seu email para pesquisarmos a sua conta e recuperar a sua senha!</p>

    @if (session('status'))
        <p style="color: blue">{{ session()->get('status') }} </p>
    @endif

    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div><br>
    
        <input type="submit" value="Enviar">
    </form>
    
     
    
@endsection