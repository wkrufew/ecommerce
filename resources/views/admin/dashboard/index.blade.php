<x-admin-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h1>
            </div>
        </div>
    </header>

    <div class="contenedor  mt-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- primera columna --}}
            <div class="p-4 bg-white rounded-md grid grid-cols-1">
                <div class="grid grid-cols-4 gap-2">
                    {{-- TABLAS Y NUMERO --}}
                    <div class="py-2 bg-[#60A3BD] text-white rounded-md text-center">
                        <p class="text-center">{{$productospublicados}}</p>
                        <p class="text-xs">Productos Publicados</p>
                    </div>
                    <div class="text-center py-2 bg-[#60A3BD] text-white rounded-md">
                        <span>$ {{$ordenes}}</span>
                        <P class="text-xs">Total Ventas</P>
                    </div>
                    <div class="text-center py-2 bg-[#60A3BD] text-white rounded-md">
                        <span>{{ $users }}</span>
                        <P class="text-xs">Total Usuarios</P>
                    </div>
                    <div class="text-center py-2 bg-[#60A3BD] text-white rounded-md">
                        <span>{{ $comentarios }}</span>
                        <P class="text-xs">Total Comentarios</P>
                    </div>
                </div>
                {{-- GRAFICOS --}}
                <div>
                    <table class="min-w-full divide-y divide-gray-200 mt-6">
                        <caption class="caption-top font-medium">
                            Tabla 2: Los 10 productos mas vendidos.
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Producto
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Precio
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($topproducts)
                                @foreach ($topproducts as $productName => $details)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                            {{$productName}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                            {{$details['quantity']}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                            {{$details['price']}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div>Sin registros</div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- segunda columna --}}
            <div class="p-4 bg-white rounded-md">
                {{-- top usuarios --}}
                <div>
                    <table class="min-w-full divide-y divide-gray-200 mt-6">
                        <caption class="caption-top font-medium">
                            Table 3: Los 10 usuarios con mas compras.
                        </caption>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre Usuario
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($topusers)
                                @foreach ($topusers as $user)
                                    @php
                                        $userData = \App\Models\User::find($user->user_id);
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">{{ $userData->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">{{ $user->total_spent }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <div>Sin registros</div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>