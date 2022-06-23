@props(['icon', 'route' => null, 'as' => 'a'])

<x-partials.buttons.base :as="$as" :route="$route"
    {{ $attributes->merge(['class' => 'text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500']) }}>
    <i class="fas {{ $icon }}"></i>
</x-partials.buttons.base>
