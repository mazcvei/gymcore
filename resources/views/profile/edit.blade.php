@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h2 class="mb-4 fw-bold text-center">Mi Perfil</h2>

    {{-- MENSAJE DE ÉXITO --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-5">
            <div class="card auth-card p-4">
                <h4 class="mb-3">Editar datos</h4>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellidos</label>
                        <input
                            type="text"
                            name="lastname"
                            class="form-control @error('lastname') is-invalid @enderror"
                            value="{{ old('lastname', $user->lastname) }}">
                        @error('lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

               
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Nueva contraseña">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                     {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label">Confrimar contraseña</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirmar contraseña">
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Guardar cambios
                    </button>
                </form>
            </div>
        </div>

        {{-- SUSCRIPCIÓN --}}
        <div class="col-lg-7">
            <div class="card p-4 mb-4">
                <h4 class="mb-3">Mi suscripción</h4>

                @if($suscripcion)

                @php
          
                     $isExpired = \Carbon\Carbon::parse($suscripcion->end_date)->isPast();

                @endphp

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Estado:</strong>
                            <span class="badge {{ $isExpired ? 'bg-danger' : 'bg-success' }}">
                                {{ $isExpired ? 'Expirado' : 'Activo' }}
                            </span>
                        </p>
                        <p><strong>Plan:</strong> {{ $suscripcion->membershipPlan->name }}</p>
                    </div>

                    <div class="col-md-6">
                        <p><strong>Inicio:</strong> {{ $suscripcion->start_date }}</p>
                        <p><strong>Fin:</strong> {{ $suscripcion->end_date }}</p>
                    </div>
                </div>
                @else
                <p class="text-muted">No tienes suscripción activa.</p>
                @endif
            </div>

            {{-- CLASES RESERVADAS --}}
            <div class="card p-4">
                <h4 class="mb-3">Mis clases reservadas</h4>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Clase</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)

                            @php
                            $estadoClass = match($reservation->status) {
                                'Reservada' => 'bg-success',
                                'Pendiente' => 'bg-warning',
                                'Cancelada' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                            @endphp

                            <tr>
                                <td>{{ $reservation->classSchedule->gymclass->name }}</td>
                                <td>{{ $reservation->classSchedule->date }}</td>
                                <td>{{ $reservation->classSchedule->start_time_formatted }}</td>
                                <td>
                                    <span class="badge {{ $estadoClass }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($reservation->status !== 'Cancelada')
                                    <form method="POST" action="{{ route('reservations.destroy', $reservation->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-outline-danger btn-sm">
                                            Cancelar reserva
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No tienes reservas aún
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection