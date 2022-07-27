@extends('layouts.auth')

@section('content')

<h2>Editar perfil</h2>

<form action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div>
        <input type="text" name="first_name" value="{{ $user->first_name }}">
        @error('first_name')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name="last_name" value="{{ $user->last_name }}">
        @error('last_name')
            <p>{{ $message }}</p>
        @enderror
    </div><br>
    <div>
        <label for="">Foto</label>
        <input type="file" name="picture">
        @error('picture')
            <p>{{ $message }}</p>
        @enderror
    </div><br>
    <div>
        <label for="">Site</label>
        <input type="text" name="web" value="{{ $user->web }}">
        @error('web')
            <p>{{ $message }}</p>
        @enderror
    </div><br>
    <div>
        <label for="">companhia</label>
        <input type="text" name="company" value="{{ $user->company }}">
        @error('company')
            <p>{{ $message }}</p>
        @enderror
    </div><br>
    <div>
        <label for="">Cidade</label>
        <input type="text" name="city" value="{{ $user->city }}">
        @error('city')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div><br>
        <p><label for="">Bio</label></p>
        @error('bio')
            <p>{{ $message }}</p>
        @enderror
        <textarea name="bio" cols="30" rows="10">{{ $user->bio }}</textarea>
    </div><br>
    <input type="submit" value="Editar">
</form>

@endsection