@extends('layouts.app')
@section('content')
<section class="hero text-center">
    <div class="container">
        <h1>Reserva, entrena y mejora cada día</h1>
        <p class="lead mt-3">
            Reserva clases, controla tu progreso y organiza tu entrenamiento
        </p>
        <a href="{{route('register')}}" class="btn btn-light btn-lg mt-4">
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
                        Consulta la agenda de clases y reserva de forma rápida y sencilla desde cualquier dispositivo.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <h4>Gran variedad</h4>
                    <p>
                            Accede a diferentes entrenamientos como fitness, yoga o cross training adaptados a tu nivel.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <h4>Entrenadores cualificados</h4>
                    <p>
                        Disfruta de sesiones guiadas por profesionales que te ayudarán a alcanzar tus objetivos.
                    </p>
                </div>
            </div>
            <div class="col-md-2 m-auto mt-4">
                  <a href="{{route('classes.index')}}" class="btn btn-primary">
                        Ver clases
                    </a>
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


            @foreach($plans as $plan)
            <div class="col-12 col-md-6 col-lg-3">

                <div class="card h-100 text-center p-4 
                    {{ $plan->is_popular ? 'border-success shadow' : '' }}">

               
                    @if($plan->is_popular)
                        <span class="badge bg-success mb-2">
                            Más popular
                        </span>
                    @endif

             
                    <h5 class="fw-bold">
                        {{ $plan->name }}
                    </h5>

               
                    <h2 class="my-3 text-success">
                        @if($plan->price == 0)
                            Gratis
                        @else
                            {{ $plan->price }}€
                        @endif
                    </h2>

          
                    <p class="text-muted">
                        {{ $plan->description }}
                    </p>

                    <ul class="list-unstyled mb-4">
                        @foreach(@json_decode($plan->features) as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>

      
                    @if($plan->price == 0)
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                            Probar ahora
                        </a>
                    @else
                        <a href="{{ route('payments.create', $plan) }}" 
                           class="btn {{ $plan->is_popular ? 'btn-success' : 'btn-primary' }}">
                            Elegir plan
                        </a>
                    @endif

                </div>

            </div>
             @endforeach

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