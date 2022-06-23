@props(['action', 'method'])

<form action="{{ $action }}" {{ $attributes->class(['p-5 bg-gray-100 grid gap-8']) }} method="post">
    @method($method)
    @csrf

    <x-partials.form.feedback.notification />

    {{ $slot }}
</form>
