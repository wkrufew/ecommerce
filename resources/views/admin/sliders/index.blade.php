<x-admin-layout>
    
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Sliders
                </h1>
                <a class= "ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md" href="{{route('admin.sliders.create')}}">
                    Agregar Slider
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (session('mensaje'))
            <div x-data="{ open: true }" class="my-6">
                <div x-show="open" class="bg-blue-500 border border-blue-600 text-blue-100 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Ok!</strong>
                    <span class="block sm:inline">{{ session('mensaje') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg x-on:click="open = false" class="fill-current h-6 w-6 text-white" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Cerrar</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            </div>
        @endif
        <div> 

            @if ($sliders->count())
                
                <table class="min-w-full divide-y divide-gray-200 mt-6">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Orden
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Imagen
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Url
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody id="sliders" class="bg-white divide-y divide-gray-200">
                        @foreach ($sliders as $slider)
                            <tr data-id="{{ $slider->id }}">
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{$slider->orden}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap handler cursor-move">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if ($slider->imagen)
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Storage::url($slider->imagen) }}" alt="">
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="https://images.pexels.com/photos/4883800/pexels-photo-4883800.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{$slider->url}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td width="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form class="formulario_eliminar" action="{{ route('admin.sliders.destroy', $slider) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm tostada"> <i
                                                class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            @else
                <div class="px-6 py-4">
                    No existen registros
                </div>
            @endif               

        </div>
    </div>
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.3/axios.min.js"
        integrity="sha512-L4lHq2JI/GoKsERT8KYa72iCwfSrKYWEyaBxzJeeITM9Lub5vlTj8tufqYk056exhjo2QDEipJrg6zen/DDtoQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        new Sortable(sliders, {
            handle: '.handler',
            animation: 150,
            ghostClass: 'bg-secondary',
            store: {
                set: function(sortable) {
                    const sorts = sortable.toArray();
                    Swal.fire({
                        position: 'top-end',
                        width: 400,
                        /* background: '#333333', */
                        toast: true,
                        timerProgressBar: true,
                        icon: 'success',
                        title: 'Cambio de orden exitoso!',
                        showConfirmButton: false,
                        timer: 4000
                    })
                    axios.post("{{ route('api.sort.sliders') }}", {
                        sorts: sorts
                    }).catch(function(error) {
                        console.log(error);
                    });
                }
            }
        });

        @if (Session::has('mensaje'))
            Swal.fire({
                position: 'top-end',
                width: 400,
                /* background: '#333333', */
                toast: true,
                timerProgressBar: true,
                icon: 'success',
                title: '{{ session('mensaje') }}',
                showConfirmButton: false,
                timer: 4000
            })
        @endif

        $('.formulario_eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Esta seguro de aliminar esta imagen?',
                text: "La imagen sera eliminada permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar esto!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    
                }
            })
        })
    </script>
    @endpush

</x-admin-layout>