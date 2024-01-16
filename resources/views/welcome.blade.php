<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Sistema de Agendamento de Consultas</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>Bem-vindo ao Sistema de Agendamento de Consultas</h1>
            <p>Agende suas consultas médicas de maneira simples e eficiente.</p>
        </header>

        <section class="description">
            <p>O nosso sistema oferece uma experiência fácil e rápida para agendar consultas online. Evite filas e marque suas consultas no momento mais conveniente para você.</p>
        </section>

        <section class="options">
            <a href="{{ route('register') }}" class="btn btn-register">Cadastrar</a>
            <a href="{{ route('login') }}" class="btn btn-login">Entrar</a>
        </section>
    </div>
</body>
</html>