@props(['route' => '', 'as' => 'a'])

<x-partials.buttons.base :as="$as" :route="$route"
    {{ $attributes->merge(['class' => 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-500 disabled:hover:bg-red-600']) }}>
    {{ $slot }}
</x-partials.buttons.base>
