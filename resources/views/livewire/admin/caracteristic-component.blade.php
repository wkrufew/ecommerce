<div class="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Producto: {{$product->name}}
        </h2>
    </x-slot>

    <div class="contenedor py-12">
        {{-- Agregar departamento --}}
        <x-form-section submit="save" class="mb-6">
    
            <x-slot name="title">
                Agregar una nueva caracteristica
            </x-slot>
    
            <x-slot name="description">
                Complete la información necesaria para poder agregar un nueva caracteristica
            </x-slot>
    
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label>
                        Titulo
                    </x-label>
    
                    <x-input wire:model.defer="createForm.title" type="text" class="w-full mt-1" />
    
                    <x-input-error for="createForm.title" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label>
                        Descripcion
                    </x-label>
    
                    <x-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
    
                    <x-input-error for="createForm.name" />
                </div>
            </x-slot>
    
            <x-slot name="actions">
    
                <x-action-message class="mr-3" on="saved">
                    Caracteristica agregada
                </x-action-message>
    
                <x-button>
                    Agregar
                </x-button>
            </x-slot>
        </x-form-section>
    
        {{-- Mostrar provincias --}}
        <x-action-section>
            <x-slot name="title">
                Lista de Caracteristicas
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas las caracteristicas agregadas
            </x-slot>
    
            <x-slot name="content">
    
                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Titulo</th>
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>
    
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($caracteristicas as $caracteristica)
                            <tr>
                                <td class="py-2">
                                <span class="uppercase">
                                    {{$caracteristica->title}}
                                </span>
                                </td>
                                <td class="py-2">
                                    <span class="uppercase">
                                        {{$caracteristica->name}}
                                    </span>
                                    </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$caracteristica}})">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCaracteristica', {{$caracteristica->id}})">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
            </x-slot>
        </x-action-section>
    
        {{-- Modal editar --}}
        <x-dialog-modal wire:model="editForm.open">
    
            <x-slot name="title">
                Editar caracteristica
            </x-slot>
    
            <x-slot name="content">
    
                <div class="space-y-3">
                   
                    <div>
                        <x-label>
                            Titulo
                        </x-label>
    
                        <x-input wire:model="editForm.title" type="text" class="w-full mt-1" />
    
                        <x-input-error for="editForm.title" />
                    </div>

                    <div>
                        <x-label>
                            Nombre
                        </x-label>
    
                        <x-input wire:model="editForm.name" type="text" class="w-full mt-1" />
    
                        <x-input-error for="editForm.name" />
                    </div>
    
                 
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-danger-button>
            </x-slot>
    
        </x-dialog-modal>
    </div>

    @push('script')
        <script>
            Livewire.on('deleteCaracteristica', cityId => {
            
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.caracteristic-component', 'delete', cityId)
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>