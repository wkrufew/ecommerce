<div class="mt-0">
    <div class="bg-gray-200 rounded-md p-4 border">
        {{-- Color --}}
        <div class="">
            <x-label>
                Elegir un color
            </x-label>
            <div class="grid grid-cols-7 gap-6 mt-4 mb-4">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" name="color_id" wire:model.defer="color_id" value="{{ $color->id }}">
                        <span class="ml-1 text-gray-700 text-sm capitalize">
                            {{ __($color->name) }}
                        </span>
                    </label>
                @endforeach
            </div>
            <x-input-error for="color_id" />
        </div>

        {{-- Cantidad --}}
        <div>
            <x-label class="mb-2">
                Cantidad
            </x-label>
            <x-input type="number" wire:model.defer="quantity" placeholder="Ingrese una cantidad" class="w-full" />
            <x-input-error for="quantity" />
        </div>

        <div class="flex justify-center items-center mt-4">
            <x-action-message class="mr-3" on="saved">
                Agregado
            </x-action-message>
            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                Agregar
            </x-button>
        </div>
    </div>

    @if ($size_colors->count())
        
        <div class="mt-8">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">
                            Color
                        </th>

                        <th class="px-4 py-2 w-1/3">
                            Cantidad
                        </th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($size_colors as $size_color)
                        <tr wire:key="size_color-{{ $size_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($size_color->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $size_color->pivot->quantity }} unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-secondary-button class="ml-auto mr-2"
                                    wire:click="edit({{ $size_color->pivot->id }})" wire:loading.attr="disabled"
                                    wire:target="edit({{ $size_color->pivot->id }})">
                                    Actualizar
                                </x-secondary-button>

                                <x-danger-button
                                    wire:click="$emit('deleteColorSize', {{ $size_color->pivot->id }})">
                                    Eliminar
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif

    <x-dialog-modal wire:model="open" wire:key="modal-size-product-{{$size->id}}">

        <x-slot name="title">
            Editar colores
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label>
                    Color
                </x-label>

                <select class="form-control w-full" wire:model="pivot_color_id">
                    <option value="">Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ ucfirst(__($color->name)) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-label>
                    Cantidad
                </x-label>
                <x-input class="w-full" wire:model="pivot_quantity" type="number"
                    placeholder="Ingrese una cantidad" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-button>
        </x-slot>

    </x-dialog-modal>
</div>