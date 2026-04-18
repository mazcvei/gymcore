@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row g-4">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ha ocurrido un error:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- 🔹 Imagen -->
        <div class="col-md-6">
            <div class="card">
                @if($gymClass->image)
                <img src="{{ asset('storage/'.$gymClass->image) }}"
                    class="w-100"
                    style="height:350px; object-fit:cover; border-radius:12px;">
                @else
                <img src="https://via.placeholder.com/600x350"
                    class="w-100"
                    style="border-radius:12px;">
                @endif
            </div>
        </div>

        <!-- 🔹 Información -->
        <div class="col-md-6">
            <div class="card p-4 h-100">

                <h2 class="fw-bold mb-3">{{ $gymClass->name }}</h2>

                <p class="text-muted">
                    {{ $gymClass->description }}
                </p>

                <hr>

                <p><strong>Duración:</strong> {{ $gymClass->duration }} minutos</p>

                <p>
                    <strong>Entrenador:</strong>
                    {{ $gymClass->trainer->name }}
                </p>

                <p>
                    <strong>Capacidad total:</strong> {{ $gymClass->capacity }}
                </p>

                <hr>

            </div>
        </div>
        <div class="col-12">
    
            <h5 class="fw-bold mb-3">Reservar clase</h5>

            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="schedule_id" id="schedule_id">

                <div class="mb-4">
                    <label class="form-label">Selecciona un día</label>

                    <div class="d-flex gap-2 overflow-auto pb-2">

                        @foreach($schedules->groupBy('date') as $date => $daySchedules)
                        <button type="button"
                            class="btn btn-outline-primary day-btn"
                            data-date="{{ $date }}">

                            {{ \Carbon\Carbon::parse($date)->locale('es')->isoFormat('DD MMMM') }}
                        </button>
                        @endforeach

                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Horarios disponibles</label>

                    <div id="time-slots" class="d-flex flex-wrap gap-2">
                        <p class="text-muted">Selecciona un día primero</p>
                    </div>
                </div>

                <button class="btn btn-primary w-100">
                    Reservar plaza
                </button>
            </form>
        </div>

    </div>

</div>

<script>
    const schedules = @json($schedules);

    const dayButtons = document.querySelectorAll('.day-btn');
    const timeSlotsContainer = document.getElementById('time-slots');
    const scheduleInput = document.getElementById('schedule_id');
    const formatTime = (time) => time.substring(0, 5);

    dayButtons.forEach(btn => {
        btn.addEventListener('click', () => {

            // Reset estilos
            dayButtons.forEach(b => b.classList.remove('btn-primary'));
            btn.classList.add('btn-primary');

            const selectedDate = btn.dataset.date;

            const filtered = schedules.filter(s => s.date === selectedDate);

            timeSlotsContainer.innerHTML = '';

            filtered.forEach(schedule => {

                const available = schedule.max_capacity - schedule.current_reservations;

                let button = document.createElement('button');
                button.type = "button";

                button.className = "btn " +
                    (available > 0 ? "btn-outline-primary" : "btn-secondary");

                button.disabled = available <= 0;

                button.innerText = `${formatTime(schedule.start_time)} - ${formatTime(schedule.end_time)} (${available} plazas)`;

                button.onclick = () => {
                    document.querySelectorAll('#time-slots button')
                        .forEach(b => b.classList.remove('btn-primary'));

                    button.classList.remove('btn-outline-primary');
                    button.classList.add('btn-primary');

                    scheduleInput.value = schedule.id;
                };

                timeSlotsContainer.appendChild(button);
            });
        });
    });
</script>

@endsection