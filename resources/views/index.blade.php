@extends('layouts.default')

@section('content')
<div style="border: 1px solid black; padding:20px 10px">
    <a href="{{ route('login') }}">Entrar</a>&nbsp;|
    <a href="{{ route('register') }}">Criar conta</a>
</div>

<h2>
    Este é o DevsBlog, o local ideal para programadores fascinados por criação de conteúdo e partilha de conhecimento 😁
</h2>
    
@endsection