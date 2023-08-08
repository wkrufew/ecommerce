<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Servicios
                </h1>

                <x-danger-button wire:click="$emit('deleteService')">
                    Eliminar
                </x-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

        <h1 class="text-xl text-center font-semibold mb-4">Complete esta información para crear un servicio</h1>

        <div class="mb-4 overflow-hidden rounded-md" wire:ignore>
            <form action="{{ route('admin.services.files', $service) }}" method="POST" class="dropzone" id="my-awesome-dropzone"></form>
        </div>

        @if ($service->images->count())

            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del producto</h1>

                <ul class="flex flex-wrap">
                    @foreach ($service->images as $image)

                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                            <button class="absolute right-0 top-0 w-6 h-6 flex justify-center items-center rounded-full bg-blue-800 text-white"
                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                wire:target="deleteImage({{ $image->id }})">
                                x
                            </button>
                        </li>

                    @endforeach

                </ul>
            </section>

        @endif

        {{-- <div class="bg-white shadow-xl rounded-lg p-6">
        </div> --}}

        <div class="bg-white shadow-xl rounded-lg p-6">
            {{-- Titulo --}}
            <div class="mb-4">
                <x-label value="Titulo" />
                <x-input type="text" class="w-full" wire:model="service.title"
                    placeholder="Ingrese el nombre del producto" />
                <x-input-error for="service.title" />
            </div>

            {{-- Slug --}}
            <div class="mb-4">
                <x-label value="Slug" />
                <x-input type="text" disabled wire:model="slug" class="w-full bg-gray-200"
                    placeholder="Ingrese el slug del producto" />

                <x-input-error for="slug" />
            </div>

            {{-- SubTitulo --}}
            <div class="mb-4">
                <x-label value="Subtitulo" />
                <x-input type="text" class="w-full" wire:model="service.subtitle"
                    placeholder="Ingrese el nombre del producto" />
                <x-input-error for="service.subtitle" />
            </div>

            {{-- Descrición --}}
            <div class="mb-4">
                <div wire:ignore>
                    <x-label value="Descripción" />
                    <textarea class="w-full form-control" rows="4" wire:model="service.description" x-data x-init="ClassicEditor.create($refs.miEditor)
                        .then(function(editor){
                            editor.model.document.on('change:data', () => {
                                @this.set('service.description', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );" x-ref="miEditor">
                    </textarea>
                </div>
                <x-input-error for="service.description" />
            </div>

            


            {{-- otro--}}
            {{-- <div>
                <x-label value="Otro" />
                <x-input wire:model="service.otro" type="text" class="w-full" />
                <x-input-error for="service.otro" />
            </div> --}}

            <div>
                <p class="text-sm text-center font-semibold mt-6 mb-2">Servicio Destacado</p>
                <div class="w-36 mx-auto flex justify-between">
                    <label class="mr-6">
                        <input wire:model.defer="service.status" type="radio" name="status" value="1">
                        Borrador
                    </label>
                    <label>
                        <input wire:model.defer="service.status" type="radio" name="status" value="2">
                        Publicado
                    </label>
                </div>
            </div>

            <div class="flex justify-center items-center mt-4">
                <x-action-message class="mr-3" on="saved">
                    Actualizado
                </x-action-message>
                <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                    Actualizar Servicio
                </x-button>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro",
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshService');
                }
            };


            Livewire.on('deleteService', () => {

                Swal.fire({
                    title: 'Deseas eliminar este Servicio?',
                    text: "Se eliminara de manera permanente de la base de datos!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar esto!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.edit-service', 'delete');

                        Swal.fire(
                            'Eliminado!',
                            'Su servicio fue eliminado.',
                            'Exitoso'
                        )
                    }
                })

            })
        </script>
    @endpush
</div>