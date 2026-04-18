@extends('layouts_admin.app')

@section('content')
<div class="container">

    <div class="row" style="margin-top: 5rem;">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Nueva clase</strong></h3>
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

                    <form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h4><strong>Datos de la clase</strong></h4>
                        <hr>

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Entrenador</label>
                            <select name="trainer_id" class="form-control" required>
                                <option value="">Seleccionar entrenador</option>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Capacidad</label>
                                    <input type="number" name="capacity" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duración (min)</label>
                                    <input type="number" name="duration" class="form-control" required>
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

                        <div id="schedules-wrapper"></div>

                        <button type="button" class="btn btn-default btn-sm" onclick="addSchedule()">
                            + Añadir horario
                        </button>

                        <hr>

                        <button type="submit" class="btn btn-success btn-block">
                            Crear clase
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


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
                        <input type="time" name="schedules[index][start_time]" class="form-control start-time" required>
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
let scheduleIndex = 0;

function addSchedule() {
    console.log("index: "+scheduleIndex);
    let template = document.getElementById('schedule-template').innerHTML;
    template = template.replace(/index/g, scheduleIndex);

    document.getElementById('schedules-wrapper').insertAdjacentHTML('beforeend', template);

    attachEvents(scheduleIndex);
    scheduleIndex++;
}

function removeSchedule(btn) {
    btn.closest('.schedule-item').remove();
}

function attachEvents(index) {
    const wrapper = document.querySelectorAll('.schedule-item')[index];

    const start = wrapper.querySelector('.start-time');
 

    function calc() {
        if (!start.value) return;

        let [h, m] = start.value.split(':').map(Number);

        let date = new Date();
        date.setHours(h);
     

        let endH = String(date.getHours()).padStart(2, '0');
        let endM = String(date.getMinutes()).padStart(2, '0');

        end.value = `${endH}:${endM}`;
    }

    start.addEventListener('input', calc);
}
</script>

@endsection