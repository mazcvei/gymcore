
@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4 fw-bold text-center">Clases de entrenamiento</h2>

    <div class="row g-4">

        @foreach($classes as $class)
        <div class="col-md-4">
            <div class="card feature-card h-100">

                @if($class->image)
                <img src="{{ asset('storage/'.$class->image) }}"
                    class="card-img-top"
                    style="height:200px; object-fit:cover;">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">{{ $class->name }}</h5>

                    <p class="text-muted small mb-2">
                        {{ Str::limit($class->description, 100) }}
                    </p>

                    <p class="mb-1"><strong>Duración:</strong> {{ $class->duration }} min</p>
                    <p class="mb-1"><strong>Aforo:</strong> {{ $class->capacity }}</p>
                    <p class="mb-3">
                        <strong>Entrenador:</strong> {{ $class->trainer->name }}
                    </p>

                    <a href="{{ route('classes.show', $class) }}" class="btn btn-primary mt-auto">
                        Reservar clase
                    </a>
                </div>

            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection