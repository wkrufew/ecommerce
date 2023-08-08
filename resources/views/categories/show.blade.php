<x-app-layout>
    {{-- INICIO SEO --}}
        @section('title', '- TIENDA DE SISTEMAS ELÉCTRICOS Y ELECTRÓNICOS')
        @section('description', 'Explora nuestra tienda de sistemas eléctricos y electrónicos. Ofrecemos productos, servicios y soluciones innovadoras para tus necesidades eléctricas y electrónicas!')
        @section('url', route('categories.show', $category))
        @section('img', Storage::url($category->image))
    {{-- FIN SEO --}}
    <div class="contenedor pt-4 pb-8">
        @livewire('category-filter', ['category' => $category])
    </div>
</x-app-layout>