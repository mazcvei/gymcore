@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-card p-4">

                <h3 class="text-center mb-4">Crear cuenta</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>
                        </div>

                         <div class="col-md-6 mb-3">
                            <label class="form-label">Apellidos</label>
                            <input
                                type="text"
                                name="lastname"
                                class="form-control"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contraseña</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirmar contraseña</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
                        </div>

                    </div>

                    <button class="btn btn-primary w-100 mt-2">
                        Crear cuenta
                    </button>

                </form>

                <p class="text-center mt-3">
                    ¿Ya tienes cuenta?
                    <a href="/login">Inicia sesión</a>
                </p>

            </div>
        </div>
    </div>
</div>
@endsection
