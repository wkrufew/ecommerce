<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    
    <h1 class="text-lg text-center font-semibold mb-4">Complete esta información para crear un producto</h1>

    <div class="grid grid-cols-2 gap-6 mb-4">

        {{-- Categoría --}}
        <div>
            <x-label value="Categorías" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="category_id">
                <option value="" selected disabled>Seleccione una categoría</option>

                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <x-input-error for="category_id" />
        </div>

        {{-- Subcategoría --}}
        <div>
            <x-label value="Subcategorías" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="subcategory_id">
                <option value="" selected disabled>Seleccione una subcategoría</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>

            <x-input-error for="subcategory_id" />
        </div>
    </div>

    {{-- Nombre --}}
    <div class="mb-4">
        <x-label value="Nombre" />
        <x-input type="text" 
                    class="w-full"
                    wire:model="name"
                    placeholder="Ingrese el nombre del producto" />
        <x-input-error for="name" />
    </div>

    {{-- Slug --}}
    <div class="mb-4">
        <x-label value="Slug" />
        <x-input type="text"
            disabled
            wire:model="slug"
            class="w-full bg-gray-200" 
            placeholder="Ingrese el slug del producto" />

    <x-input-error for="slug" />
    </div>

    {{-- Descrición --}}
    <div class="mb-4">
        <div wire:ignore>
            <x-label value="Descripción" />
            {{-- <textarea class="w-full form-control" rows="4"
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
            </textarea> --}}
            <textarea class="w-full border border-gray-200 rounded-md shadow-sm" rows="3"
                wire:model="description">
            </textarea>
        </div>
        <x-input-error for="description" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
        {{-- Marca --}}
        <div>
            <x-label value="Marca" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="brand_id">
                <option value="" selected disabled>Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>

            <x-input-error for="brand_id" />
        </div>

        {{-- Precio --}}
        <div>
            <x-label value="Precio" />
            <x-input 
                wire:model="price"
                type="number" 
                class="w-full" 
                step=".01" />
            <x-input-error for="price" />
        </div>

        {{-- descuento --}}
        <div>
            <x-label value="Descuento (Menor que el precio)" />
            <x-input 
                wire:model.lazy="discount"
                type="number" 
                class="w-full" 
                step=".01" />
            <x-input-error for="discount" />
            @if (isset($price) && isset($discount))
                @if ($this->price > $this->discount)
                    @php
                        $monto = $this->price - $this->discount;
                        $discount = ($monto / $this->price) * 100;
                    @endphp
                    <div class="text-green-500 text-xs py-1 px-2">- {{ intval($discount) }} %</div>
                @else
                    <div class="text-red-500 text-xs py-1 px-2">El descuento debe ser menor al precio</div>
                @endif                
            @endif
        </div>
    </div>

    @if ($subcategory_id)
        @if (!$this->subcategory->color && !$this->subcategory->size)
            <div class="mb-4">
                <x-label value="Cantidad" />
                <x-input 
                    wire:model="quantity"
                    type="number" 
                    class="w-full" />
                <x-input-error for="quantity" />
            </div>
        @endif
    @endif

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- link video --}}
        <div>
            <x-label value="Link Video" />
            <x-input 
                wire:model="video"
                type="text" 
                class="w-full"/>
            <x-input-error for="video" />
        </div>
        {{-- ficha tecnica --}}
        <div>
            <x-label value="Ficha Tecnica" />
            <x-input 
                wire:model="ficha"
                type="text" 
                class="w-full" />
            <x-input-error for="ficha" />
        </div>
    </div>

    <div class="mt-10 flex justify-center">
        <x-button
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save"
            class="">
            Crear producto
        </x-button>
    </div>

</div>