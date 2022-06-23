@props(['description', 'fields', 'actions' => null])

<section {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            {{ $description }}
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="overflow-hidden shadow sm:rounded-md">
            <div {{ $fields->attributes->merge(['class' => 'px-4 py-5 grid gap-6 bg-white sm:p-6']) }}>
                {{ $fields }}
            </div>

            @isset($actions)
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </div>
</section>
