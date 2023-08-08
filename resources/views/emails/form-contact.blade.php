<x-mail::message>

<x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
</x-slot:header>

# Formulario de Contacto

Hola, esta es una solicitud de informacion de contacto.

# Datos del Usuario
<x-mail::panel>
    <b>Nombre: </b>{{ $data['name'] }} <br>
    <b>Correo: </b>{{ $data['email'] }}<br>
    <b>Telefono: </b>{{ $data['phone'] }} <br>
    <b>Mensaje: </b>{{ $data['message'] }} <br>
</x-mail::panel>

Gracias por confiar en nosotros,<br>
{{ config('app.name') }}

</x-mail::message>
