@extends('layouts_admin.app')

@section('content')
<div class="container">

    <div class="row" style="margin-top: 5rem;">
        <div class="col-md-8 col-md-offset-2">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Editar clase</strong></h3>
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

                    <form action="{{ route('admin.classes.update', $gymClass) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h4><strong>Datos de la clase</strong></h4>
                        <hr>

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $gymClass->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="description" class="form-control">{{ old('description', $gymClass->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Entrenador</label>
                            <select name="trainer_id" class="form-control" required>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}"
                                        {{ $gymClass->trainer_id == $trainer->id ? 'selected' : '' }}>
                                        {{ $trainer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Capacidad</label>
                                    <input type="number" name="capacity" class="form-control"
                                           value="{{ old('capacity', $gymClass->capacity) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duración (min)</label>
                                    <input type="number" name="duration" class="form-control"
                                           value="{{ old('duration', $gymClass->duration) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        {{-- ================= HORARIOS ================= --}}
                        <h4 style="margin-top:30px;"><strong>Horarios</strong></h4>
                        <hr>

                        <div id="schedules-wrapper">

                          @foreach($gymClass->schedules as $i => $schedule)
                            <div class="panel panel-info schedule-item">
                                <div class="panel-body">

                                    <input type="hidden" name="schedules[{{ $i }}][id]" value="{{ $schedule->id }}">

                                    <button type="button" class="close" onclick="removeSchedule(this)">
                                        <span>&times;</span>
                                    </button>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha</label>
                                                <input type="date"
                                                    name="schedules[{{ $i }}][date]"
                                                    class="form-control"
                                                    value="{{ $schedule->date }}"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Inicio</label>
                                                <input type="time"
                                                    name="schedules[{{ $i }}][start_time]"
                                                    class="form-control"
                                                    value="{{ $schedule->start_time }}"
                                                    required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Capacidad</label>
                                        <input type="number"
                                            name="schedules[{{ $i }}][max_capacity]"
                                            class="form-control"
                                            value="{{ $schedule->max_capacity }}"
                                            required>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-default btn-sm" onclick="addSchedule()">
                            + Añadir horario
                        </button>

                        <hr>

                        <button type="submit" class="btn btn-success btn-block">
                            Actualizar clase
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- TEMPLATE --}}
<div id="schedule-template" style="display:none;">
    <div class="panel panel-info schedule-item">
        <div class="panel-body">

            <button type="button" class="close" onclick="removeSchedule(this)">
                <span>&times;</span>
            </button>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" name="schedules[index][date]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Inicio</label>
                        <input type="time" name="schedules[index][start_time]" class="form-control" required>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label>Capacidad</label>
                <input type="number" name="schedules[index][max_capacity]" class="form-control" required>
            </div>

        </div>
    </div>
</div>

<script>
let scheduleIndex = {{ $gymClass->schedules->count() }};

function addSchedule() {
    let template = document.getElementById('schedule-template').innerHTML;
    template = template.replace(/index/g, scheduleIndex);

    document.getElementById('schedules-wrapper')
        .insertAdjacentHTML('beforeend', template);

    scheduleIndex++;
}

function removeSchedule(btn) {
    btn.closest('.schedule-item').remove();
}
</script>

@endsection