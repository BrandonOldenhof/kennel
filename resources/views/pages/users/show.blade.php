@extends('base.template')

@section('page-title')
    Gebruikersoverzicht | {{ config('app.name') }}
@endsection

@section('content')
    <x-partials.table class="py-8">
        <x-slot:title>
            <h1 class="text-xl font-semibold text-gray-900">Gebruikers</h1>
            <p class="mt-2 text-sm text-gray-700">Een lijst van alle gebruikers met naam, email en rol.</p>
        </x-slot:title>

        <x-slot:actions>
            <x-partials.buttons.primary route="{{ route('users.create') }}">Gebruiker aanmaken
            </x-partials.buttons.primary>
        </x-slot:actions>

        <x-slot:headings>
            <x-partials.table.heading class="sticky left-0 z-10">Naam</x-partials.table.heading>
            <x-partials.table.heading>E-mail adres</x-partials.table.heading>
            <x-partials.table.heading>Rol</x-partials.table.heading>
        </x-slot:headings>

        <x-slot:rows>
            <tr>
                <x-partials.table.heading class="sticky left-0 z-10">
                    <a href="{{ route('users.edit', $user) }}" class="underline">{{ $user->name }}</a>
                </x-partials.table.heading>
                <x-partials.table.cell>{{ $user->email }}</x-partials.table.cell>
                <x-partials.table.cell>{{ $user->isAdmin() ? 'Admin' : 'Gebruiker' }}
                </x-partials.table.cell>
            </tr>
        </x-slot:rows>
    </x-partials.table>
@endsection
