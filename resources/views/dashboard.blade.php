
<!DOCTYPE html>
<html>
    <head>
        <title>Agendamento de Consultas</title>
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    </head>
    <body>
        <header>
            <h1>Bem-vindo ao Sistema de Agendamento de Consultas</h1>
        </header>
        <nav>
            <a href="{{ route('consultations.indexAndCreate') }}" >Adicionar Consultas</a>
            <a href="{{ route('patients.register') }}" class="btn btn-register">Adicionar pacientes</a>
            <a href="{{ route('doctors.indexAndCreate') }}" class="btn btn-register">Adicionar Médicos</a>
            <a href="{{ route('specialtys.register') }}" class="btn btn-register">Adicionar Especialidades</a>
        </nav>
        <section>
            @yield('content')
            <img src="{{ asset('images/background.jpg') }}" alt="Background">
        </section>
    </body>
</html>