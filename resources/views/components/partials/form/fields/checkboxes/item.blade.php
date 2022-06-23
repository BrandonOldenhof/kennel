@props(['name', 'value', 'label', 'current' => null, 'checked' => null])

@php
$checked = $current !== null && $checked !== null ? $checked : in_array($value, old($name, $current) ?? []);
@endphp

<div {{ $attributes->class(['flex items-center']) }}>
    <input id="{{ "{$name}-{$value}" }}" name="{{ $name }}" type="checkbox" value="{{ $value }}"
        class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
        {{ $checked === true ? 'checked="checked"' : '' }}>
    <label for="{{ "{$name}-{$value}" }}"
        class="block ml-3 text-sm font-medium text-gray-700">{{ $label }}</label>
</div>
