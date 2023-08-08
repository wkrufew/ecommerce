<x-app-layout>  
    {{-- INICIO SEO --}}
        @section('title', '- ACERCA DE NOSOTROS')
        @section('description', 'Explora nuestra tienda de sistemas eléctricos y electrónicos. Ofrecemos productos, servicios y soluciones innovadoras para tus necesidades eléctricas y electrónicas!')
        @section('url', route('about'))
        @section('img', asset('https://images.pexels.com/photos/7070/space-desk-workspace-coworking.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'))
        @section('type', 'article')
    {{-- FIN SEO --}}
    <section class="relative overflow-hidden bg-white pt-6">
        <div class="h-auto md:h-auto  max-w-5xl mx-4 bg-center object-cover top-0 left-0 z-0 md:mx-6 lg:mx-auto">
            <img src="https://images.pexels.com/photos/7070/space-desk-workspace-coworking.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="portada"
                class="object-cover fotoportada w-full h-72 rounded-md">
        </div>
    </section>
    <section class=" relative bg-white pt-1 md:pt-4">
        <div class="max-w-2xl mx-auto mt-6">
            <div class="grid grid-cols-1 lg:grid-cols-1">
                <P class="text-center font-semibold text-base md:text-lg text-[#60A3BD] px-2">
                    {{ __('Nuestra Historia') }}
                </P>
            </div>
            <p class="py-4 px-6 text-justify text-gray-800 text-sm">
                {{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo necessitatibus quis ad id quas eius suscipit tempore voluptatem nesciunt labore. Tempore quaerat, commodi veritatis maxime dignissimos repellendus assumenda minima iusto!') }}
            </p>
        </div>
    </section>
    <section class=" relative bg-white py-5 mb-2">
        <div class="max-w-6xl mx-auto  grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-x-28">
            <div class="text-center text-gray-800">
                <b class="text-[#60A3BD] text-center font-semibold text-base md:text-lg"> {{ __('Misión') }}</b><br>
                <p class="px-6 text-justify mt-2 py-2 text-sm">
                    {{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo necessitatibus quis ad id quas eius suscipit tempore voluptatem nesciunt labore. Tempore quaerat, commodi veritatis maxime dignissimos repellendus assumenda minima iusto!') }}
                </p>
            </div>
            <div class="text-center text-gray-800">
                <b class="text-[#60A3BD] text-center font-semibold text-base md:text-lg"> {{ __('Visión') }}</b><br>
                <p class="px-6 text-justify py-2 text-sm">
                     {{ __('Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo necessitatibus quis ad id quas eius suscipit tempore voluptatem nesciunt labore. Tempore quaerat, commodi veritatis maxime dignissimos repellendus assumenda minima iusto!') }}
                </p>
            </div>
        </div>
    </section>
</x-app-layout>
