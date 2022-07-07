@extends('layouts.default')

@section('content')

<h2>Olá {{ $user->first_name }} {{ $user->last_name }}, seja bem-vindo</h2>
<p>
    O processo está quase concluído, enviamos um link de confirmação no seu email
</p>

<p><a href="{{ route('verification.send') }}">Reenviar Link de confirmação</a></p>
    
@endsection