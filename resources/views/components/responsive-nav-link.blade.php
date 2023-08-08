@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-1 border-l-2  text-left text-base font-medium border-[#60A3BD] text-[#60A3BD] focus:outline-none focus:text-white focus:bg-[#60A3BD] focus:border-[#60A3BD] transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
