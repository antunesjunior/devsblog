<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DevsBlog</title>
    <style>
        *{font-family: 'Courier New', Courier, monospace}
    </style>
</head>
<body>
    <header>
        <h1><a href="{{ route('index') }}">DEVSBLOG</a></h1>
        <hr>
    </header>

    <div style="border: 1px solid black; padding:20px 10px">
        <a href="{{ route('index') }}">Home</a>&nbsp;|
        <a href="{{ route('login') }}">Entrar</a>&nbsp;|
        <a href="{{ route('register') }}">Criar conta</a>
    </div>

    <main>
        @yield('content')
    </main>

    <br><br>
    <footer>
        <p>
            <small>
                <strong>Devsblog</strong><i> - Todos direitos reservados</i>
            </small>
        </p>
    </footer>
</body>
</html>