<div>
    <div class="contenedor bg-white gap-6 p-3 rounded-md">
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-0 rounded-lg">
            @forelse ($services as $service)
                <li class="shadow-lg rounded-lg bg-white transition overflow-hidden ease-in-out hover:scale-105 duration-300 hover:shadow-neutral-500 border">
                    <article class="flex-1 flex flex-col justify-between h-full">
                        <figure>
                            @if ($service->images->isNotEmpty())
                                <img class="h-40 w-full object-cover object-center" src="{{ Storage::url($service->featuredImage()) }}" alt="{{ $service->title }}">
                            @endif
                        </figure>
                        <div class="">
                            <div class="py-3 px-4">
                                <h1 class="font-semibold">
                                    <a class="text-sm" href="{{ route('services.show', $service) }}">
                                        {{ $service->title }}
                                    </a>
                                </h1>
                                <p class="font-medium text-xs text-neutral-700 pt-2">
                                    {{ Str::limit($service->subtitle, 80) }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-1 md:mt-auto py-2 w-full mx-auto ">
                            <div class="pb-2 px-3 flex justify-between">
                                <div class="text-xs text-neutral-700"><i class="fa-solid fa-user mr-1"></i> {{$settings['ceo']}}</div>
                                <div class="text-xs text-neutral-700"><i class="fa-solid fa-clock  font-semibold"></i> {{ $service->created_at->diffForHumans() }}</div>
                            </div>
                            <a class="px-4 py-2 mx-2 bg-neutral-800 text-white text-sm font-medium rounded-full flex justify-center" href="{{ route('services.show', $service) }}">
                                {{ __('Más información') }}
                            </a>
                        </div>
                    </article>
                </li>
            @empty
                <li class="col-span-3">
                    <span class="block sm:inline text-xs">{{ __('Lo sentimos no hemos encontrado registros, vuelve a intentarlo.') }}</span>
                </li>
            @endforelse
        </ul>
    </div>
</div>
