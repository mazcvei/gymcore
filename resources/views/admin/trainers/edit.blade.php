@extends('layouts_admin.app')

@section('content')
<div class="container">

    <div class="row" style="margin-top: 5rem;">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>
                            {{ isset($trainer) ? 'Editar entrenador' : 'Nuevo entrenador' }}
                        </strong>
                    </h3>
                </div>

                <div class="panel-body">

                    {{-- ERRORES --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin-bottom:0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ isset($trainer) 
                        ? route('admin.trainers.update', $trainer) 
                        : route('admin.trainers.store') }}"
                        method="POST">

                        @csrf
                        @if(isset($trainer))
                            @method('PUT')
                        @endif

                        {{-- NOMBRE --}}
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $trainer->name ?? '') }}"
                                   required>
                        </div>

                        {{-- APELLIDO --}}
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text"
                                   name="lastname"
                                   class="form-control"
                                   value="{{ old('lastname', $trainer->lastname ?? '') }}">
                        </div>

                        {{-- EMAIL --}}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $trainer->email ?? '') }}"
                                   required>
                        </div>

                        {{-- TELÉFONO --}}
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone', $trainer->phone ?? '') }}">
                        </div>

                        {{-- PASSWORD --}}
                        <div class="form-group">
                            <label>
                                Password 
                                @if(isset($trainer))
                                    <small>(solo si deseas cambiarla)</small>
                                @endif
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   {{ isset($trainer) ? '' : 'required' }}>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="form-group">
                            <label>Confirmar password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   {{ isset($trainer) ? '' : 'required' }}>
                        </div>

                        <hr>

                        {{-- BOTÓN --}}
                        <button type="submit" class="btn btn-success btn-block">
                            {{ isset($trainer) ? 'Actualizar entrenador' : 'Crear entrenador' }}
                        </button>

                        <a href="{{ route('admin.trainers.index') }}" 
                           class="btn btn-default btn-block">
                            Cancelar
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection