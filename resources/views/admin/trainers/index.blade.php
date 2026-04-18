@extends('layouts_admin.app')
@section('content')


<div class="container">

       @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    <div class="row" style="margin-bottom:20px; margin-top: 5rem;">
        <div class="col-md-6">
            <h2 style="margin-top:0;"><strong>Entrenadores</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.trainers.edit') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus" style="color:white"></i> Nuevo entrenador
            </a>
        </div>
    </div>

    {{-- GRID --}}
    <div class="row row-eq-height">
        

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($trainers as $index => $trainer)
                    <tr>

                        <td>
                            {{ $trainer->name }} {{ $trainer->lastname }}
                        </td>

                        <td>{{ $trainer->email }}</td>

                        <td>{{ $trainer->phone ?? '—' }}</td>

                        <td>
                            <a href="{{ route('admin.trainers.edit', $trainer) }}"
                                class="btn btn-xs btn-primary">
                                Editar
                            </a>

                            <form action="{{ route('admin.trainers.destroy', $trainer) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-xs btn-danger"
                                    onclick="return confirm('¿Eliminar entrenador?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay entrenadores registrados
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection