@props(['category'])

<div class="grid grid-cols-4 p-2 h-full overflow-auto">
    <div class="col-span-2 pl-2 h-auto overflow-auto">
        <p class="font-semibold py-2 text-sm text-[#60A3BD]">Subcategorias</p>
        <ul class="space-y-1">
            @forelse ($category->subcategories as $subcategory)
                <li>
                    <a href="{{route('categories.show', $category ) . '?subcategoria=' . $subcategory->slug }}" class="inline-block text-sm hover:text-[#60A3BD]">
                        {{$subcategory->name}}
                    </a>
                </li>
            @empty
                <li>Sin Subcategorias por el momento</li>
            @endforelse
        </ul>
    </div>
    <div class="col-span-2 flex justify-center items-center h-auto w-full">
        <img class="w-full h-[200px] object-cover object-center rounded-md" src="{{Storage::url($category->image)}}" alt="{{$category->name}}">
    </div>
</div>