<x-admin-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Formulario de Slider
                </h1>
            </div>
        </div>
    </header>

    <div class="max-w-5xl mx-auto p-6 bg-white rounded-md mt-10">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="url" value="URL" />
                <x-input type="text" name="url" id="url" class="w-full" placeholder="Ingrese la URL de redireccion" />
                <x-input-error for="url" />
            </div>
            <div class="mb-4">
                <p class="text-xs text-gray-500"><b>Nota: </b> seleccione una imagen rectangular (1220 x 425)px</p>
                <x-label for="file" value="Imagen" />
                <input accept="image/*" type="file" name="file" id="file" class="mt-1">
                <x-input-error for="file" />
            </div>
            <div class="flex justify-center py-4">
                <img id="picture" style="border-radius: 8px;"
                    src="https://cdn.pixabay.com/photo/2020/04/06/13/37/coffee-5009730_960_720.png" width="300px" alt="">
            </div>
            <div class="mt-10 flex justify-center">
                <x-button type="submit">
                    Guardar
                </x-button>
            </div>
        </form>
        
    </div>
    <script>
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>
</x-admin-layout>