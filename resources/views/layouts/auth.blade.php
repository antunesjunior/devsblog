<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DevsBlog</title>
    <style>
        *{
            font-family: 'Courier New', Courier, monospace;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <header>
        <h1><a href="{{ route('index') }}">DEVSBLOG</a></h1>
        <hr>
        <div style="border: 1px solid black; padding:20px 10px">
            <a href="{{ route('home') }}"><strong>Home</strong></a>&nbsp;|
            <a href="{{ route('users.meet') }}"><strong>Descobrir Autores</strong></a>&nbsp;|
            <a href="{{ route('posts.create') }}"><strong>Criar Artigo</strong></a>&nbsp;|
            <a href="{{ route('user.show', auth()->user()->username) }}"><strong>Perfil</strong></a>&nbsp;|
            <a href="{{ route('logout') }}"><strong>Sair</strong></a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <br>
    <br>
    <footer>
        <p>
            <small>
                <strong>Devsblog</strong><i> - Todos direitos reservados</i>
            </small>
        </p>
    </footer>
</body>
</html>