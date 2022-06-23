@props(['label', 'name', 'checked' => false, 'tooltip' => null, 'help' => null])

<label class="block">
    <span class="flex items-center justify-between">
        <span class="flex items-center">
            <span class="text-gray-700">{{ $label }}</span>

            @isset($tooltip)
                <i class="ml-2 text-gray-500 fas fa-question-circle" title="{{ $information }}"></i>
            @endisset
        </span>

        @if (!$attributes->has('required'))
            <span class="text-sm text-gray-500">Optioneel</span>
        @endif
    </span>

    <div class="relative inline-block w-10 mr-2 align-middle transition duration-200 ease-in select-none">
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1"
            {{ $checked === true ? 'checked="checked"' : '' }}
            class="absolute block w-6 h-6 bg-white border-4 rounded-full appearance-none cursor-pointer checked:right-0" />
        <label for="{{ $name }}"
            class="block h-6 overflow-hidden bg-gray-300 rounded-full cursor-pointer"></label>
    </div>

    @isset($help)
        <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endisset
</label>
