  @props(['label', 'tooltip' => null, 'description' => null])

  <fieldset {{ $attributes }}>
      <span class="flex items-center justify-between">
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

      @isset($description)
          <p class="text-sm leading-5 text-gray-500">{{ $description }}</p>
      @endisset

      <div class="mt-4 space-y-4">
          {{ $slot }}
      </div>
  </fieldset>
