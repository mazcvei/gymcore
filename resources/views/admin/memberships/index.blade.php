@extends('layouts_admin.app')
@section('content')


<div class="container" style="min-height: 90vh;">

       @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    <div class="row" style="margin-bottom:20px; margin-top: 5rem;">
        <div class="col-md-6">
            <h2 style="margin-top:0;"><strong>Membresías</strong></h2>
        </div>
       
    </div>

    <div class="row row-eq-height">
        

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Fecha suscripción</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($memberships as $membership)
                    <tr>

                        <td>
                            {{ $membership->user->name }} {{ $membership->user->lastname }}
                        </td>

                        <td>{{ $membership->user->email }}</td>

                        <td>{{ $membership->membershipPlan->name }}</td>

                        <td>{{ Carbon\Carbon::parse($membership->created_at)->format('d/m/Y H:i:s') }}</td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No hay suscripciones registradas
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
                        