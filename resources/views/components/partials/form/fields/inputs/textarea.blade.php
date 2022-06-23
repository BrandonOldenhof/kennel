@props(['name', 'value' => old($name)])

<textarea name="{{ $name }}"
    {{ $attributes->class([
        'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' => $errors->first(
            $name,
        ),
        'block w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',
    ]) }}> {{ $value }} </textarea>
