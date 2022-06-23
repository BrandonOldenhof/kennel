<div {{ $attributes->class(['px-4 sm:px-6 lg:px-8']) }}>
    <div class="sm:flex sm:items-center">
        <div {{ $title->attributes->class(['sm:flex-auto']) }}>
            {{ $title }}
        </div>
        <div {{ $actions->attributes->class(['mt-4 sm:mt-0 sm:flex-none']) }}>
            {{ $actions }}
        </div>
    </div>
    <div class="flex flex-col mt-8">
        <div class="inline-block min-w-full py-2 align-middle">
            <div class="min-w-full overflow-auto shadow-sm ring-1 ring-black ring-opacity-5 table-wrapper">
                <table class="w-full min-w-full border-separate" style="border-spacing: 0">
                    <thead
                        {{ $headings->attributes->class(['bg-gray-100 sticky top-0 z-20 min-w-full drop-shadow-[0_1px_1px_rgba(229,231,235,1)]']) }}>
                        <tr>
                            {{ $headings }}
                        </tr>
                    </thead>
                    <tbody {{ $rows->attributes->class(['bg-white']) }}>
                        {{ $rows }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
