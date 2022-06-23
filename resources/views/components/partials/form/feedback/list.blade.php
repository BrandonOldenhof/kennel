@props(['errors'])

<ul class="mt-3 text-sm text-red-600 list-disc list-inside">
    @foreach ($errors as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
