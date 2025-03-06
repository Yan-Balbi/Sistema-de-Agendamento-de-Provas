<div class="teste">
    <nav class="nav">
        <div class="logo">
            <img src="{{ asset('images/iff-logo.png') }}" width="100%">
        </div>
        <div class="div-nav-link">
            <ul class="nav-links">
                <li><a class="navbar-link" href="inicio">Início</a></li>

                <li class="nav-item dropdown">
                    <a class="navbar-link dropdown-toggle" href="#" id="professoresDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Professores
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="professoresDropdown">
                        <li><a class="btn btn-primary w-100 text-start" href="{{route('professor.create')}}">Cadastro</a></li>
                        <li><a class="btn btn-secondary w-100 text-start mt-1" href="{{route('professor.listar')}}">Listagem</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="navbar-link dropdown-toggle" href="#" id="disciplinasDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Disciplinas
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="disciplinasDropdown">
                        <li><a class="btn btn-primary w-100 text-start" href="#">Cadastro</a></li>
                        <li><a class="btn btn-secondary w-100 text-start mt-1" href="#">Listagem</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="navbar-link dropdown-toggle" href="#" id="cursosDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Cursos
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="cursosDropdown">
                        <li><a class="btn btn-primary w-100 text-start" href="cursos/create">Cadastro</a></li>
                        <li><a class="btn btn-secondary w-100 text-start mt-1" href="{{ route('cursos.index') }}">Listagem</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="navbar-link dropdown-toggle" href="#" id="turmasDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Turmas
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="turmasDropdown">
                        <li><a class="btn btn-primary w-100 text-start" href="turmas/create">Cadastro</a></li>
                        <li><a class="btn btn-secondary w-100 text-start mt-1" href="{{ route('turmas.index') }}">Listagem</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="navbar-link dropdown-toggle" href="#" id="salasDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Salas
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="salasDropdown">
                        <li><a class="btn btn-primary w-100 text-start" href="{{ route('salas.create') }}">Cadastro</a>
                        </li>
                        <li><a class="btn btn-secondary w-100 text-start mt-1"
                                href="{{ route('salas.index') }}">Listagem</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="navbar-link" href="{{ url('agendamento') }}">Agendamentos</a>
                </li>


            </ul>
        </div>
        <div class="btn-login-container">
            @if (Route::has('login'))
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-login">
                            Logout
                        </button>
                    </form>
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
</div>
