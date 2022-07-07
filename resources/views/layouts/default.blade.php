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

    <main>
        @yield('content')
    </main>

    <footer>
        <p>
            <small>
                <strong>Devsblog</strong><i> - Todos direitos reservados</i>
            </small>
        </p>
    </footer>
</body>
</html>