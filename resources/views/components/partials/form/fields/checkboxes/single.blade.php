  @props(['label', 'description' => null])

  <fieldset {{ $attributes }}>
      <label class="text-gray-700">{{ $label }}</label>

      @isset($description)
          <p class="mt-4 text-sm leading-5 text-gray-500">{{ $description }}</p>
      @endisset

      <div class="mt-4 space-y-4">
          {{ $slot }}
      </div>
  </fieldset>
