@extends('layouts.default')

@section('content')

<h2>Criar Conta</h2>

<form action="" method="post">
    @csrf
    <div class="form-group">
        <input type="text" name="first_name" placeholder="Primeiro nome">
    </div>

    <div class="form-group">
        <input type="text" name="last_name" placeholder="Ultimo nome">
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder="Email">
    </div>

    <div class="form-group">
        <input type="password" name="senha" placeholder="Password">
    </div>

    <input type="submit" value="cadastrar">
</form>

@endsection