@props(['route' => '', 'as' => 'a'])

<x-partials.buttons.base :as="$as" :route="$route"
    {{ $attributes->merge(['class' => 'text-white bg-green-600 hover:bg-green-700 focus:ring-green-500 disabled:hover:bg-green-600']) }}>
    {{ $slot }}
</x-partials.buttons.base>
