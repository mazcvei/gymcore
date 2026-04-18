{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'GymCore') }}
        </a>

        {{-- Botón responsive --}}
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Contenido --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{-- Left --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Clases</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Planes</a>
                </li>

            </ul>

            {{-- Right --}}
            <ul class="navbar-nav ms-auto align-items-lg-center">

                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Iniciar sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-outline-primary ms-lg-2 mt-2 mt-lg-0"
                           href="{{ route('register') }}">
                            Registrarse
                        </a>
                    </li>

                @else

                    {{-- Admin (opcional) --}}
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                Admin
                            </a>
                        </li>
                    @endif

                    {{-- Usuario --}}
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="#">
                                    Perfil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>

                @endguest

            </ul>

        </div>
    </div>
</nav>