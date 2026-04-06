@extends('layouts.app')
@section('content')
<section class="hero text-center">
    <div class="container">
        <h1>Reserva, entrena y mejora cada día</h1>
        <p class="lead mt-3">
            Reserva clases, controla tu progreso y organiza tu entrenamiento
        </p>
        <a href="/register" class="btn btn-light btn-lg mt-4">
            Empieza ahora
        </a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <h4>Reserva de clases</h4>
                    <p>
                        Reserva clases de forma rápida y sencilla desde cualquier dispositivo.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <h4>Control de aforo</h4>
                    <p>
                        Consulta plazas disponibles en tiempo real para cada actividad.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <h4>Gestión completa</h4>
                    <p>
                        Administradores pueden gestionar usuarios, clases y estadísticas.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Planes de suscripción</h2>
            <p class="text-muted">
                Elige el plan que mejor se adapte a tu entrenamiento
            </p>
        </div>

        <div class="row g-4 justify-content-center">

            <!-- Plan prueba -->

            <div class="col-md-3">
                <div class="card h-100 text-center p-4">
                    
                    <h5 class="fw-bold">Prueba</h5>

                    <h2 class="my-3 text-success">
                        Gratis
                    </h2>

                    <p class="text-muted">
                        1 día de acceso completo al gimnasio
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li>Acceso a instalaciones</li>
                        <li>Clases disponibles</li>
                        <li>Sin compromiso</li>
                    </ul>

                    <a href="/register" class="btn btn-outline-primary">
                        Probar ahora
                    </a>

                </div>
            </div>

            <!-- Plan mensual -->

            <div class="col-md-3">
                <div class="card h-100 text-center p-4">

                    <h5 class="fw-bold">1 Mes</h5>

                    <h2 class="my-3 text-success">
                        35€
                    </h2>

                    <p class="text-muted">
                        Acceso completo durante 1 mes
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li>Acceso ilimitado</li>
                        <li>Reservar clases</li>
                        <li>Soporte incluido</li>
                    </ul>

                    <a href="/register" class="btn btn-primary">
                        Elegir plan
                    </a>

                </div>
            </div>

            <!-- Plan 3 meses (destacado) -->

            <div class="col-md-3">
                <div class="card h-100 text-center p-4 border-success shadow">

                    <span class="badge bg-success mb-2">
                        Más popular
                    </span>

                    <h5 class="fw-bold">3 Meses</h5>

                    <h2 class="my-3 text-success">
                        99€
                    </h2>

                    <p class="text-muted">
                        Ahorra con un plan trimestral
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li>Acceso ilimitado</li>
                        <li>Reservar clases</li>
                        <li>Descuento incluido</li>
                    </ul>

                    <a href="/register" class="btn btn-success">
                        Elegir plan
                    </a>

                </div>
            </div>

            <!-- Plan anual -->

            <div class="col-md-3">
                <div class="card h-100 text-center p-4">

                    <h5 class="fw-bold">1 Año</h5>

                    <h2 class="my-3 text-success">
                        300€
                    </h2>

                    <p class="text-muted">
                        La mejor opción para entrenar todo el año
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li>Acceso ilimitado</li>
                        <li>Reservas prioritarias</li>
                        <li>Mayor ahorro</li>
                    </ul>

                    <a href="/register" class="btn btn-primary">
                        Elegir plan
                    </a>

                </div>
            </div>

        </div>

    </div>
</section>

<section class="gym-gallery">

<div id="gymCarousel" class="carousel slide" data-bs-ride="carousel">

    <!-- indicadores -->

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#gymCarousel" data-bs-slide-to="3"></button>
    </div>

    <!-- imágenes -->

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100 carousel-img" alt="Gimnasio">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100 carousel-img" alt="Entrenamiento">
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100 carousel-img" alt="Clases">
        </div>

          <div class="carousel-item">
            <img src="{{ asset('images/slide4.jpg') }}" class="d-block w-100 carousel-img" alt="Clases">
        </div>

    </div>

    <!-- controles -->

    <button class="carousel-control-prev" type="button" data-bs-target="#gymCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#gymCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

</section>
@endsection