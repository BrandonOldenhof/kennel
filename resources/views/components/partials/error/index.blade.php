@props(['statusCode', 'title', 'description', 'withButton' => true, 'route' => route('home'), 'label' => 'Back to home'])

<div class="min-h-full px-4 py-16 bg-white sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
    <div class="mx-auto max-w-max">
        <main class="sm:flex">
            <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl">{{ $statusCode }}</p>
            <div class="sm:ml-6">
                <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">{{ $title }}
                    </h1>
                    <p class="mt-1 text-base text-gray-500">{{ $description }}</p>
                </div>

                @if ($withButton === true)
                    <div class="flex mt-10 space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                        <x-partials.buttons.primary :route="$route">{{ $label }}</x-partials.buttons.primary>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
