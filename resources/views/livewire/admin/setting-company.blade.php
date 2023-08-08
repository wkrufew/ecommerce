<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Configuracion
        </h2>
    </x-slot>

    <div class="contenedor py-6">
        {{-- Agregar departamento --}}
        <x-form-section submit="saveSettings" class="mb-6">
            <x-slot name="title">
                Datos de la Empresa
            </x-slot>
            <x-slot name="description">
                Ingrese todos los datos para su correcto funcionamiento
            </x-slot>
            <x-slot name="form">
                <div class="flex flex-col md:flex-row col-span-6 justify-between space-y-1">
                    <div class="">
                        <x-label>
                            CEO
                        </x-label>
                        <x-input wire:model.defer="ceo" type="text" class="w-full mt-1" />
                        <x-input-error for="ceo" />
                    </div>
                    <div class="">
                        <x-label>
                            Telefono 1
                        </x-label>
                        <x-input wire:model.defer="phone1" type="text" class="w-full mt-1" />
                        <x-input-error for="phone1" />
                    </div>
                    <div class="">
                        <x-label>
                            Telefono 2 (Whatsapp)
                        </x-label>
                        <x-input wire:model.defer="phone2" type="text" class="w-full mt-1" placeholder="593XXXXXXXXX"/>
                        <x-input-error for="phone2" />
                    </div>
                </div>
                <div class="flex flex-col md:flex-row col-span-6 justify-between space-y-1">
                    <div class="">
                        <x-label>
                            Email 1
                        </x-label>
                        <x-input wire:model.defer="email1" type="text" class="w-full mt-1" />
                        <x-input-error for="email1" />
                    </div>
                    <div class="">
                        <x-label>
                            Email 2
                        </x-label>
                        <x-input wire:model.defer="email2" type="text" class="w-full mt-1" />
                        <x-input-error for="email2" />
                    </div>
                    <div class="">
                        <x-label>
                            Direccion
                        </x-label>
                        <x-input wire:model.defer="address" type="text" class="w-full mt-1" />
                        <x-input-error for="address" />
                    </div>
                </div>
                <div class="col-span-6 bg-[#60A3BD] text-white rounded-md text-center py-2 font-semibold text-sm">
                    <p>Redes Sociales</p>
                </div>
                <div class="flex flex-col md:flex-row col-span-6 justify-between space-y-1 space-x-0 md:space-x-2">
                    <div class="">
                        <x-label>
                            Facebook
                        </x-label>
                        <x-input wire:model.defer="facebook" type="text" class="w-full mt-1" />
                        <x-input-error for="facebook" />
                    </div>
                    <div class="">
                        <x-label>
                            Instagram
                        </x-label>
                        <x-input wire:model.defer="instagram" type="text" class="w-full mt-1" />
                        <x-input-error for="instagram" />
                    </div>
                    <div class="">
                        <x-label>
                            TikTok
                        </x-label>
                        <x-input wire:model.defer="whatsapp" type="text" class="w-full mt-1" />
                        <x-input-error for="whatsapp" />
                    </div>
                </div>
                <div class="col-span-6 bg-[#60A3BD] text-white rounded-md text-center py-2 font-semibold text-sm">
                    <p>Datos bancarios</p>
                </div>
                <div class="flex flex-col md:flex-row col-span-6 justify-between space-y-1 space-x-0 md:space-x-2">
                    <div class="">
                        <x-label>
                            Banco
                        </x-label>
                        <x-input wire:model.defer="banco" type="text" class="w-full mt-1" />
                        <x-input-error for="banco" />
                    </div>
                    <div class="">
                        <x-label>
                            Tipo de Cuenta
                        </x-label>
                        <x-input wire:model.defer="tipocuenta" type="text" class="w-full mt-1" />
                        <x-input-error for="tipocuenta" />
                    </div>
                    <div class="">
                        <x-label>
                            Numero de Cuenta
                        </x-label>
                        <x-input wire:model.defer="cuenta" type="text" class="w-full mt-1" />
                        <x-input-error for="cuenta" />
                    </div>
                    <div class="">
                        <x-label>
                            Cedula
                        </x-label>
                        <x-input wire:model.defer="cedula" type="text" class="w-full mt-1" />
                        <x-input-error for="cedula" />
                    </div>
                </div>
                <div class="col-span-6 bg-[#60A3BD] text-white rounded-md text-center py-2 font-semibold text-sm">
                    <p>Mensaje promocional para el banner</p>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    {{-- <x-label>
                        Mensaje Banner
                    </x-label>
                    <x-input wire:model.defer="banner" type="text" class="w-full mt-1" />
                    <x-input-error for="banner" /> --}}
                    <div wire:ignore>
                        <x-label value="Descripción" />
                        <textarea class="w-full form-control" rows="4"
                            wire:model.defer="banner"
                            x-data 
                            x-init="ClassicEditor.create($refs.miEditor)
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('banner', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );"
                            x-ref="miEditor">
                        </textarea>
                    </div>
                </div>
                <div class="col-span-6 bg-[#60A3BD] text-white rounded-md text-center py-2 font-semibold text-sm">
                    <p>Mapa de la ubicacion de la empresa</p>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-label>
                        Mapa
                    </x-label>
                    <x-input wire:model.defer="maps" type="text" class="w-full mt-1" />
                    <x-input-error for="maps" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-action-message class="mr-3" on="saved">
                    Datos guardados.
                </x-action-message>
                <x-button>
                    Guardar
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>
