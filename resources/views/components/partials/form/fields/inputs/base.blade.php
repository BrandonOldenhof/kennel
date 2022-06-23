@props(['type' => 'text', 'name', 'value' => old($name), 'prefix' => null, 'suffix' => null])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
    {{ $attributes->class([
        'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' => $errors->has(
            $name,
        ),
        'rounded-tr rounded-br' => $prefix !== null,
        'rounded-tl rounded-bl' => $suffix !== null,
        'rounded-md' => $prefix === null && $suffix === null,
        'block w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none disabled:cursor-not-allowed',
    ]) }} />
