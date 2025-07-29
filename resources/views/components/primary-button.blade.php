@props([
    'tag' => '',
    'href' => '#',
    'customClass' => 'bg-red-500 hover:bg-red-600',
])

@if ($tag == 'a')
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 my-3 ml-3 ' . $customClass . ' border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}
        href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 my-3 ml-3 ' . $customClass . ' border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@endif