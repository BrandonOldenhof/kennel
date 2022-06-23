@props(['route' => '', 'as' => 'a'])

<x-partials.buttons.base :as="$as" :route="$route"
    {{ $attributes->merge(['class' => 'text-white bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 disabled:hover:bg-gray-600']) }}>
    {{ $slot }}
</x-partials.buttons.base>
