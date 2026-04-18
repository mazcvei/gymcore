@extends('layouts.app')

@section('content')

<div class="container py-5">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card auth-card p-4">


                <h3 class="mb-4 text-center">Pago con tarjeta</h3>
         

            <div class="card mb-4 p-3">

                <h5 class="mb-3 text-center">Resumen de suscripción</h5>

                <div class="text-center">

                    {{-- Badge --}}
                    @if($membershipplan->is_popular)
                        <span class="badge bg-success mb-2">Más popular</span>
                    @endif

                    {{-- Nombre --}}
                    <h4>{{ $membershipplan->name }}</h4>

                    {{-- Precio --}}
                    <h2 style="color: var(--gym-green);">
                        {{ $membershipplan->price == 0 ? 'Gratis' : $membershipplan->price . '€' }}
                    </h2>

                    {{-- Descripción --}}
                    <p class="text-muted">{{ $membershipplan->description }}</p>
                </div>

                {{-- Features --}}
                <ul class="list-unstyled text-center mt-3">
                    @foreach(json_decode($membershipplan->features) as $feature)
                        <li>✔ {{ $feature }}</li>
                    @endforeach
                </ul>

                <hr>

                {{-- Subtotal --}}
                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <strong>
                        {{ $membershipplan->price == 0 ? 'Gratis' : $membershipplan->price . '€' }}
                    </strong>
                </div>

                {{-- IVA --}}
                <div class="d-flex justify-content-between">
                    <span>IVA</span>
                    <strong>Incluido</strong>
                </div>

                {{-- Total --}}
                <div class="d-flex justify-content-between mt-2">
                    <strong>Total</strong>
                    <strong style="color: var(--gym-green); font-size: 1.2rem;">
                        {{ $membershipplan->price == 0 ? 'Gratis' : $membershipplan->price . '€' }}
                    </strong>
                </div>

            </div>

                <form method="POST" action="{{ route('payments.store',$membershipplan) }}" id="form_pay">
                    @csrf

                    <!-- Nombre completo -->
                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input
                            type="text"
                            name="name_lastname"
                            class="form-control"
                            value="{{ Auth::user()->name }} {{ Auth::user()->lastname }}"
                            placeholder="Nombre apellidos"
                            required>
                    </div>

                    <!-- Número de tarjeta -->
                    <div class="mb-3">
                        <label class="form-label">Número de tarjeta</label>
                        <input
                            type="text"
                            name="card_number"
                            class="form-control"
                            placeholder="1234 5678 9012 3456"
                            maxlength="19"
                            required>
                    </div>

                    <!-- Fila: fecha + CVV -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha expiración</label>
                            <input
                                type="text"
                                name="expiry"
                                class="form-control"
                                placeholder="MM/AA"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">CVV</label>
                            <input
                                type="text"
                                name="cvv"
                                class="form-control"
                                placeholder="123"
                                maxlength="4"
                                required>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label class="form-label">Dirección de facturación</label>
                        <input
                            type="text"
                            name="address"
                            class="form-control"
                            placeholder="Calle, ciudad..."
                            required>
                    </div>

                    <!-- Botón -->
                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        Pagar ahora
                    </button>

                </form>

            </div>

        </div>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("form_pay");

        form.addEventListener("submit", function(e) {
            let errors = [];

            const name = form.name_lastname.value.trim();
            const number = form.card_number.value.replace(/\s+/g, '');
            const expiry = form.expiry.value.trim();
            const cvv = form.cvv.value.trim();
            const address = form.address.value.trim();

            // Nombre
            if (name.length < 3) {
                errors.push("El nombre debe tener al menos 3 caracteres.");
            }

            // Número tarjeta (16 dígitos)
            if (!/^\d{16}$/.test(number)) {
                errors.push("El número de tarjeta debe tener 16 dígitos.");
            }

            // Formato MM/AA
            if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
                errors.push("La fecha debe tener formato MM/AA.");
            } else {
                const [month, year] = expiry.split('/');
                const currentDate = new Date();
                const currentYear = currentDate.getFullYear() % 100;
                const currentMonth = currentDate.getMonth() + 1;

                if (year < currentYear || (year == currentYear && month < currentMonth)) {
                    errors.push("La tarjeta está caducada.");
                }
            }

            // CVV (3 o 4 dígitos)
            if (!/^\d{3,4}$/.test(cvv)) {
                errors.push("El CVV debe tener 3 o 4 dígitos.");
            }

            // Dirección
            if (address.length < 5) {
                errors.push("La dirección es obligatoria.");
            }

            // Mostrar errores
            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join("\n"));
            }
        });

        // Formateo automático tarjeta
        const cardInput = document.querySelector('input[name="card_number"]');
        cardInput.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\D/g, '').substring(0, 16);
            value = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = value;
        });

        // Formateo MM/AA
        const expiryInput = document.querySelector('input[name="expiry"]');
        expiryInput.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\D/g, '').substring(0, 4);

            if (value.length >= 3) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }

            e.target.value = value;
        });
    });
</script>

@endsection