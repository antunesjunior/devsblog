@extends('layouts.auth')

@section('content')

<h2>Home</h2>

<p>Seja bem vindo <strong>{{ $user->first_name }} {{ $user->last_name }}</strong></p>

@endsection