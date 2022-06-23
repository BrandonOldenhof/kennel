@props(['label', 'name', 'options', 'value' => old($name), 'tooltip' => null, 'help' => null])

<label class="block">
    <span class="flex items-center justify-between mb-2">
        <span class="flex items-center">
            <span class="text-gray-700">{{ $label }}</span>

            @isset($tooltip)
                <i class="ml-2 text-gray-500 fas fa-question-circle" title="{{ $tooltip }}"></i>
            @endisset
        </span>

        @if (!$attributes->has('required'))
            <span class="text-sm text-gray-500">Optioneel</span>
        @endif
    </span>

    <div class="relative flex rounded-md shadow-sm">
        <select name="{{ $name }}" class="w-full border-gray-300 rounded-md shadow-sm">
            <option value="">Kies een optie</option>

            @foreach ($options as $key => $label)
                <option value="{{ $key }}" {{ $value === $key ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>

        @error($name)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 text-red-600 pointer-events-none">
                <i class="fas fa-exclamation-circle"></i>
            </div>
        @enderror
    </div>

    @isset($help)
        <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endisset

    @error($name)
        <x-partials.form.feedback.list :errors="$errors->get($name)" />
    @enderror
</label>
