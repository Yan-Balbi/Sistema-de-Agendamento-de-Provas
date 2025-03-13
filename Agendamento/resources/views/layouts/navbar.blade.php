<div class="teste">
    <nav class="nav">
        <div class="logo">
            <a class="navbar-link" href="/"><img src="{{ asset('images/iff-logo.png') }}" width="100%"></a>
        </div>
        <div class="div-nav-link">
            <ul class="nav-links">
                <li><a class="navbar-link" href="/">Início</a></li>

                @canany(['professor-create', 'professor-list'])
                    <li class="nav-item dropdown">
                        <a class="navbar-link dropdown-toggle" href="#" id="professoresDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Professores
                        </a>
                        <ul class="dropdown-menu p-2" aria-labelledby="professoresDropdown">
                            @can('professor-create')
                                <li><a class="btn btn-primary w-100 text-start"
                                        href="{{ route('professor.create') }}">Cadastro</a></li>
                            @endcan
                            @can('professor-list')
                                <li><a class="btn btn-secondary w-100 text-start mt-1"
                                        href="{{ route('professor.listar') }}">Listagem</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['disciplina-create', 'disciplina-list'])
                    <li class="nav-item dropdown">
                        <a class="navbar-link dropdown-toggle" href="#" id="disciplinasDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Disciplinas
                        </a>
                        <ul class="dropdown-menu p-2" aria-labelledby="disciplinasDropdown">
                            @can('disciplina-create')
                                <li><a class="btn btn-primary w-100 text-start"
                                        href="{{ route('disciplina.create') }}">Cadastro</a></li>
                            @endcan
                            @can('disciplina-list')
                                <li><a class="btn btn-secondary w-100 text-start mt-1"
                                        href="{{ route('disciplina.listar') }}">Listagem</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['curso-create', 'curso-list'])
                    <li class="nav-item dropdown">
                        <a class="navbar-link dropdown-toggle" href="#" id="cursosDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Cursos
                        </a>
                        <ul class="dropdown-menu p-2" aria-labelledby="cursosDropdown">
                            @can('curso-create')
                                <li><a class="btn btn-primary w-100 text-start" href="{{ route('cursos.create') }}">Cadastro</a>
                                </li>
                            @endcan
                            @can('curso-list')
                                <li><a class="btn btn-secondary w-100 text-start mt-1"
                                        href="{{ route('cursos.index') }}">Listagem</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['turma-create', 'turma-list'])
                    <li class="nav-item dropdown">
                        <a class="navbar-link dropdown-toggle" href="#" id="turmasDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Turmas
                        </a>
                        <ul class="dropdown-menu p-2" aria-labelledby="turmasDropdown">
                            @can('turma-create')
                                <li><a class="btn btn-primary w-100 text-start" href="{{ route('turmas.create') }}">Cadastro</a>
                                </li>
                            @endcan
                            @can('turma-list')
                                <li><a class="btn btn-secondary w-100 text-start mt-1"
                                        href="{{ route('turmas.index') }}">Listagem</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['sala-create', 'sala-list'])
                    <li class="nav-item dropdown">
                        <a class="navbar-link dropdown-toggle" href="#" id="salasDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Salas
                        </a>
                        <ul class="dropdown-menu p-2" aria-labelledby="salasDropdown">
                            @can('sala-create')
                                <li><a class="btn btn-primary w-100 text-start" href="{{ route('salas.create') }}">Cadastro</a>
                                </li>
                            @endcan
                            @can('sala-list')
                                <li><a class="btn btn-secondary w-100 text-start mt-1"
                                        href="{{ route('salas.index') }}">Listagem</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <li class="nav-item dropdown">
                    <a class="navbar-link dropdown-toggle" href="#" id="agendamentosDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Agendamentos
                    </a>
                    <ul class="dropdown-menu p-2" aria-labelledby="agendamentosDropdown">
                        @can('agendamento-create')
                            <li><a class="btn btn-primary w-100 text-start"
                                    href="{{ route('agendamentos.create') }}">Cadastro</a></li>
                        @endcan
                        <li><a class="btn btn-secondary w-100 text-start mt-1"
                                href="{{ route('agendamentos.index') }}">Listagem</a></li>
                    </ul>
                </li>

                @canany(['role-list', 'user-list'])
                    <li class="nav-item dropdown">
                        <a class="navbar-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Administração
                        </a>
                        <ul class="dropdown-menu p-2" aria-labelledby="adminDropdown">
                            @can('role-list')
                                <li><a class="btn btn-primary w-100 text-start" href="{{ route('roles.index') }}">Papéis</a>
                                </li>
                            @endcan
                            @can('user-list')
                                <li><a class="btn btn-secondary w-100 text-start mt-1"
                                        href="{{ route('users.index') }}">Usuários</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany



            </ul>
        </div>
        <div class="btn-login-container">
            @if (Route::has('login'))
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-login">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        Entrar
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-login">
                            Cadastrar-se
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>
</div>
