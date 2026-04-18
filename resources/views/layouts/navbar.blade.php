<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand" href="{{ route('home') }}">GymCore</a>

        <div class="ms-auto">

            @guest
                {{-- USUARIO NO AUTENTICADO --}}
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-primary">
                    Registro
                </a>
            @endguest


            @auth
                {{-- USUARIO AUTENTICADO --}}
               
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                Mi perfil
                            </a>
                        </li>
                        @if(isAdmin())
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    Panel de administración
                                </a>
                            </li>
                        @endif

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            @endauth

        </div>
    </div>
</nav>