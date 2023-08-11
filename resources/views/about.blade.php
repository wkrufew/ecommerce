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
                    {{ __('Quienes Somos') }}
                </P>
            </div>
            <p class="py-4 px-6 text-justify text-gray-800 text-sm">
                {{ __('Somos una empresa que inició sus actividades económicas el 08 de Noviembre del 2021 con RUC 0603926692001. Nos especializamos en la venta de componentes eléctricos, electrónicos y de automatización de las mejores marcas. Ofrecemos garantía en todos nuestros productos y servicios para nuestros clientes en todo el Ecuador. ¡Contáctanos hoy mismo y descubre cómo podemos ayudarte a mejorar tus proyectos!') }}
            </p>
        </div>
    </section>
    <section class=" relative bg-white py-5 mb-2">
        <div class="max-w-6xl mx-auto  grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-x-28">
            <div class="text-center text-gray-800">
                <b class="text-[#60A3BD] text-center font-semibold text-base md:text-lg"> {{ __('Misión') }}</b><br>
                <p class="px-6 text-justify mt-2 py-2 text-sm">
                    {{ __('"Inspirar la transformación tecnológica al comercializar equipos tecnológicos innovadores y al implementar sistemas automatizados y ecosostenibles. Nuestro objetivo es proporcionar productos de excelente calidad y precio, permitiendo a nuestros clientes disfrutar de las bondades de las últimas tecnologías en su vida diaria."') }}
                </p>
            </div>
            <div class="text-center text-gray-800">
                <b class="text-[#60A3BD] text-center font-semibold text-base md:text-lg"> {{ __('Visión') }}</b><br>
                <p class="px-6 text-justify py-2 text-sm">
                     {{ __('"Ser reconocidos como el líder indiscutible a nivel nacional en la comercialización e implementación de sistemas de control y automatización. Nos destacamos por la integración de tecnologías ecológicas sostenibles, ofreciendo soluciones inteligentes que optimicen la eficiencia y la sustentabilidad en diversos sectores de la sociedad."') }}
                </p>
            </div>
        </div>
    </section>
</x-app-layout>
