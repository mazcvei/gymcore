@extends('layouts_admin.app')
@section('content')
<style>
.panel {
    transition: all 0.2s ease;
}

.panel:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}
.row-eq-height {
    display: flex;
    flex-wrap: wrap;
}

.class-card {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.class-card .panel-body {
    flex-grow: 1;
}
</style>

<div class="container">

        {{-- HEADER --}}
    <div class="row" style="margin-bottom:20px; margin-top: 5rem;">
        <div class="col-md-6">
            <h2 style="margin-top:0;"><strong>Clases</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.classes.create') }}" class="btn btn-success">
                <i class="glyphicon glyphicon-plus" style="color:white"></i> Nueva clase
            </a>
        </div>
    </div>

    {{-- GRID --}}
   <div class="row row-eq-height">

    @foreach($classes as $class)
        <div class="col-12 col-md-4">

            <div class="panel panel-default class-card">

                {{-- IMAGEN --}}
                @if($class->image)
                    <div style="height:200px; overflow:hidden;">
                        <img src="{{ asset('storage/'.$class->image) }}"
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>
                @endif

                {{-- BODY --}}
                <div class="panel-body">

                    <h4><strong>{{ $class->name }}</strong></h4>

                    {{-- 🔥 LIMITAMOS TEXTO --}}
                    <p class="text-muted description">
                        {{ Str::limit($class->description, 120) }}
                    </p>

                    <hr>

                    <p><strong>Duración:</strong> {{ $class->duration }} min</p>
                    <p><strong>Aforo:</strong> {{ $class->capacity }}</p>
                    <p><strong>Entrenador:</strong> {{ $class->trainer->name }}</p>

                </div>

                {{-- FOOTER --}}
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.classes.edit', $class) }}" 
                               class="btn btn-primary btn-block btn-sm">
                                Editar
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <form action="{{ route('admin.classes.destroy', $class) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-block btn-sm"
                                    onclick="return confirm('¿Eliminar esta clase?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endforeach
</div>

</div>


@endsection