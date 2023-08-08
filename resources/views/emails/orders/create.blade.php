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

# ORDEN CREADA

Saludos, {{ $user->name }}</strong>, su orden ha sido creada con éxito.
<br>

# INDICACIONES DE PAGO

Para validar la orden debe realizar el deposito o transferencia a la siguiente cuenta.
<x-mail::panel>
    <b>Nombre del beneficiario: </b>{{ $settings['ceo'] }} <br>
    <b>Banco: </b>{{ $settings['banco'] }}<br>
    <b># Cuenta: </b>{{ $settings['cuenta'] }} <br>
    <b>Tipo de cuenta: </b>{{ $settings['tipocuenta'] }} <br>
    <b>Cédula: </b>{{ $settings['cedula'] }} <br>
    <b>Correo: </b>{{ $settings['email1'] }}<br>
    <b>Whatsapp: </b>{{ $settings['phone1'] }}<br> 
    <br>
    <b>Nota: </b> Si el deposito o transferencia no se realiza dentro de las 48 horas a partir de la compra se anulará la orden atomaticamente. 

</x-mail::panel>

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
@endif
@if ($order->envio_type == 2 && $envio)
    <b>Ubicacion: </b>{{$envio->department}} -  {{ $envio->city }} - {{ $envio->district }}<br>
    <b>Dirección de envío: </b>{{ $envio->address }}<br>
    <b>Referencia: </b>{{ $envio->references }}<br>
@endif
</x-mail::panel>

# LISTADO DE PRODUCTOS
<x-mail::table>
| Producto       | Precio         | Cant.      | Total          |
| :------------- | :------------- | :--------- | :------------- |
@if ($items)
    @foreach ($items as $item)
    | {{$item->name}} @isset($item->options->color) Color: {{ __($item->options->color) }} @endisset @isset($item->options->size) - {{ $item->options->size }} @endisset | ${{ $item->price }} | {{ $item->qty }} | ${{ $item->qty * $item->price }} |
    @endforeach
@endif
</x-mail::table>

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
    <p>Lo mejor para ti siempre.</p>
    <p>
        <b>Teléfono:</b> <a class="titulo1" href="tel:{{ $settings['phone1'] }}">{{ $settings['phone1'] }}</a><br>
        <b>E-mail:</b> <a class="titulo1" href="mailto:{{ $settings['email1'] }}">{{ $settings['email2'] }}</a><br>
        <b>Web:</b> <a class="titulo1" href="https://{{$_SERVER [ 'HTTP_HOST' ]}}" target="_blank"
            rel="noopener noreferrer"></a>{{$_SERVER [ 'HTTP_HOST' ]}}
    </p>
</div>

</x-mail::message>
