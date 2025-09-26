@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4 text-center">Términos y Condiciones</h2>
        <div class="card shadow-sm p-4">

            <p>Bienvenido/a a <strong>{{ config('app.name') }}</strong>. Antes de utilizar nuestra aplicación,
            te pedimos leer atentamente estos Términos y Condiciones, ya que regulan el uso de los servicios
            de compra de objetos, participación en juegos, venta, depósitos y retiros de fondos.</p>

            <h5 class="mt-4">1. Aceptación</h5>
            <p>Al registrarte y usar la aplicación, aceptas de manera expresa y voluntaria estos Términos y
            Condiciones, así como nuestra Política de Privacidad.</p>

            <h5 class="mt-4">2. Registro de Usuario</h5>
            <p>Para acceder a las funciones de compra, venta, depósitos y retiros, debes crear una cuenta
            con información veraz, completa y actualizada. Eres responsable de mantener la confidencialidad
            de tus credenciales.</p>

            <h5 class="mt-4">3. Compras y Juegos</h5>
            <ul>
                <li>Los objetos comprados dentro de la aplicación solo podrán utilizarse dentro de la misma.</li>
                <li>La participación en juegos implica riesgos de pérdida parcial o total del objeto o saldo.</li>
                <li>Los resultados de los juegos son definitivos y no admiten reclamaciones posteriores.</li>
            </ul>

            <h5 class="mt-4">4. Ventas, Depósitos y Retiros</h5>
            <ul>
                <li>Los usuarios podrán vender objetos adquiridos dentro de la app, bajo las condiciones establecidas en la plataforma.</li>
                <li>Los depósitos deben realizarse únicamente a través de los métodos autorizados por la aplicación.</li>
                <li>Los retiros estarán sujetos a verificación de identidad, plazos de procesamiento y posibles comisiones.</li>
            </ul>

            <h5 class="mt-4">5. Responsabilidad del Usuario</h5>
            <p>Eres el único responsable del uso que hagas de la aplicación, incluyendo transacciones y
            participación en juegos. <strong>{{ config('app.name') }}</strong> no se hace responsable de pérdidas
            ocasionadas por mal uso de la plataforma.</p>

            <h5 class="mt-4">6. Limitación de Responsabilidad</h5>
            <p>La aplicación se ofrece “tal cual”. No garantizamos disponibilidad continua, ausencia de errores,
            ni resultados específicos derivados del uso.</p>

            <h5 class="mt-4">7. Modificaciones</h5>
            <p>Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento.
            Los cambios serán publicados en la aplicación y se considerarán aceptados si continúas usándola.</p>

            <h5 class="mt-4">8. Legislación Aplicable</h5>
            <p>Estos términos se rigen por las leyes vigentes en el país donde operamos. Cualquier controversia
            será resuelta en tribunales competentes de dicha jurisdicción.</p>

            {{-- <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="btn btn-primary">Aceptar y continuar</a>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Rechazar</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection
