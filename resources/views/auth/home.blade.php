@extends('layouts.auth')

@section('content')

<h2>
    Home.<small style="font-size: 12px; color: blue">
        {{ $user->first_name }} {{ $user->last_name }}
    </small>
</h2>

<div><a href="#">Seguindo</a> | <a href="#">Para você</a></div>

@endsection