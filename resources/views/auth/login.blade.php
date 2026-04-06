@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card auth-card p-4">
                <h3 class="text-center mb-4">Iniciar sesión</h3>
                <form method="POST" action="{{  route('login')  }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>
                    </div>
                    <button class="btn btn-primary w-100">
                        Entrar
                    </button>
                </form>
                <p class="text-center mt-3">
                    ¿No tienes cuenta?
                    <a href="/register">Regístrate</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection