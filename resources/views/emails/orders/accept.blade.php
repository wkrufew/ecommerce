<x-mail::message>
    <style>
        .espacio {
            color: white;
            background-image: url("https://images.pexels.com/photos/355904/pexels-photo-355904.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"); /* fallback */
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            width: 100%;
            height: auto;
            padding: 15px;
        }
        .titulo1 {
            text: white;
            size: 1.8rem;
        }

        .titulo9 {
            text: white;
            size: 2.2rem;
        }

    </style>
<x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
</x-slot:header>

# PAGO DE LA ORDEN ACEPTADO

Saludos, {{ $user->name }}</strong>, su pago ha sido aceptado y su orden esta siendo procesada con éxito.
<br>

<h1><b>DATOS DE LA ORDEN</b></h1>
<x-mail::panel>
    <b># Orden: </b>{{ formatOrderNumber($order->id)}}<br>
    <b>Fecha de compra: </b>{{ $order->created_at }}<br>
    <b>Comprador: </b>{{ $order->contact }}<br>
    <b>Correo: </b>{{ $user->email }}<br>
    <b>Teléfono: </b>{{ $order->phone }}<br>
    <b>Tipo de pago: </b>Tranferencia/Deposito<br>
@if ($order->envio_type == 1)
    <b> Recoger en tienda </b> <br>
    <b>Estado de la orden: </b><span style="color: cadetblue; padding: 2px; border-radius: 50%">Pago Aceptado</span><br>
@elseif ($order->envio_type == 2 && $envio)
    <b>Ubicacion: </b>{{$envio->department}} -  {{ $envio->city }} - {{ $envio->district }}<br>
    <b>Dirección de envío: </b>{{ $envio->address }}<br>
    <b>Referencia: </b>{{ $envio->references }}<br>
    <br>
    <b>Estado de la orden: </b><span style="color: cadetblue; padding: 2px; border-radius: 50%">Pago Aceptado</span><br>
@endif
</x-mail::panel>

# VALORES DE LA ORDEN
<x-mail::panel>
    @if ($order->envio_type == 2)
        <b>Costo de envío: </b> ${{ $order->shipping_cost }}<br>
    @endif
    <b>Incluye IVA: </b>  <br>
    <b>Subtotal: </b>$ {{ $order->total - $order->shipping_cost }}<br>
    <b>Total: </b>$ {{ $order->total }}<br>
</x-mail::panel>

<x-mail::button :url="config('app.url')">
Ir a la tienda
</x-mail::button>

Gracias por confiar en nosotros,<br>
{{ config('app.name') }}

<div class="espacio">
    <h2 class="titulo9"><strong>CONSISTELEC</strong></h2>
    <p>Lo mejor para ti, siempre.</p>
    <p>
        <b>Teléfono:</b> <a class="titulo1" href="tel:{{ $settings['phone1'] }}">{{ $settings['phone1'] }}</a><br>
        <b>E-mail:</b> <a class="titulo1" href="mailto:{{ $settings['email1'] }}">{{ $settings['email2'] }}</a><br>
        <b>Web:</b> <a class="titulo1" href="https://{{$_SERVER [ 'HTTP_HOST' ]}}" target="_blank"
            rel="noopener noreferrer"></a>{{$_SERVER [ 'HTTP_HOST' ]}}
    </p>
</div>

</x-mail::message>
