<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    
    <h1 class="text-lg text-center font-semibold mb-4">Complete esta información para crear un producto</h1>

    {{-- Nombre --}}
    <div class="mb-4">
        <x-label value="Titulo" />
        <x-input type="text" 
                    class="w-full"
                    wire:model="title"
                    placeholder="Ingrese el nombre del servicio" />
        <x-input-error for="title" />
    </div>


    {{-- Slug --}}
    <div class="mb-4">
        <x-label value="Slug" />
        <x-input type="text"
            disabled
            wire:model="slug"
            class="w-full bg-gray-200" 
            placeholder="Ingrese el slug del servicio" />

    <x-input-error for="slug" />
    </div>

    <div class="mb-4">
        <x-label value="Subtitulo" />
        <x-input type="text" 
                    class="w-full"
                    wire:model="subtitle"
                    placeholder="Ingrese el nombre del servicio" />
        <x-input-error for="subtitle" />
    </div>

    {{-- Descrición --}}
    <div class="mb-4">
        <div wire:ignore>
            <x-label value="Descripción" />
            <textarea class="w-full form-control" rows="4"
                wire:model="description"
                x-data 
                x-init="ClassicEditor.create($refs.miEditor)
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );"
                x-ref="miEditor">
            </textarea>
        </div>
        <x-input-error for="description" />
    </div>

    {{-- <div class="mb-4">
        <x-label value="Otro" />
        <x-input type="text" 
                    class="w-full"
                    wire:model="otro"
                    placeholder="Ingrese" />
        <x-input-error for="otro" />
    </div> --}}

   


    <div class="mt-10 flex justify-center">
        <x-button
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save"
            class="">
            Crear Servicio
        </x-button>
    </div>

</div>