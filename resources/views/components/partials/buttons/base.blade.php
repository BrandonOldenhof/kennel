@props(['route' => null, 'as' => 'a'])
<{{ $as }} @isset($route) href="{{ $route }}" @endisset
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-25 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
    </{{ $as }}>
