<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Layout</title>

    <link rel="stylesheet" href="{{ url('CSS/estilos-header.css') }}">
    <script>
        function redirectToCadastroSala() {
            window.location.href = "{{ route('salas.create') }}";
        }
        function redirectToListagemSala() {
            window.location.href = "{{ route('salas.index') }}";
        }
    </script>
</head>

<header>
    <nav class="nav">
        <div class="logo">
            <img src="{{ asset('images/iff-logo.png') }}" width="100%">
        </div>
        <div class="div-nav-link">
            <ul class="nav-links">
                <li><a href="inicio">Início</a></li>
                <li>
                    <a>Professores</a>
                    <ul class="dropdown-menu">
                        <li><button >Cadastro</button></li>
                        <li><button >Listagem</button></li>
                    </ul>
                </li>
                <li>
                    <a>Disciplinas</a>
                    <ul class="dropdown-menu">
                        <li><button >Cadastro</button></li>
                        <li><button >Listagem</button></li>
                    </ul>
                </li>
                <li>
                    <a>Cursos</a>
                    <ul class="dropdown-menu">
                        <li><button >Cadastro</button></li>
                        <li><button >Listagem</button></li>
                    </ul>
                </li>
                <li>
                    <a>Turmas</a>
                    <ul class="dropdown-menu">
                        <li><button >Cadastro</button></li>
                        <li><button >Listagem</button></li>
                    </ul>
                </li>
                <li>
                    <a>Salas</a>
                    <ul class="dropdown-menu">
                        <li><button onclick="redirectToCadastroSala()">Cadastro</button></li>
                        <li><button onclick="redirectToListagemSala()">Listagem</button></li>
                    </ul>
                </li>
                </li>
                <li><a href="agendamento">Agendamentos</a></li>
            </ul>
        </div>
        <div class="btn-login-container">
                @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-login">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-login">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>
</header>
