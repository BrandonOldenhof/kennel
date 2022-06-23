@extends('base.template')

@section('page-title')
    Gebruiker aanmaken | {{ config('app.name') }}
@endsection

@section('content')
    <x-partials.form method="post" :action="route('users.store')">
        <x-partials.form.layouts.section id="profile-section">
            <x-slot:description>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Profiel</h3>
                <p class="mt-1 text-sm text-gray-600">Deze informatie wordt in het gebruikersoverzicht getoond</p>
            </x-slot:description>

            <x-slot:fields>
                <x-partials.form.fields.input label="Naam" name="name" :value="old('name')" required />
                <x-partials.form.fields.input type="email" label="Email adres" name="email" :value="old('email')" required />
                <x-partials.form.fields.toggle label="Is een admin gebruiker" name="is_admin" :checked="old('is_admin') === '1'" required />
            </x-slot:fields>

            <x-slot:actions>
                <x-partials.buttons.primary as="button">Opslaan</x-partials.buttons.primary>
            </x-slot:actions>
        </x-partials.form.layouts.section>


        <x-partials.form.layouts.divider />

        <x-partials.form.layouts.section id="password-section">
            <x-slot:description>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Wachtwoord</h3>
                <p class="mt-1 text-sm text-gray-600">Het wachtwoord is niet zichtbaar in het overzicht en kan na het
                    aanmaken niet via het CMS aangepast worden. De gebruiker kan zelf het wachtwoord resetten door op het
                    login scherm op de "Wachtwoord vergeten" link te klikken</p>
            </x-slot:description>

            <x-slot:fields>
                <x-partials.form.fields.input type="password" label="Wachtwoord" value="" name="password"
                    help="Het wachtwoord moet uit minimaal 8 tekens bestaan en een combinatie van hoofdletters, kleine letters, cijfers en symbolen bevatten."
                    required />

                <x-partials.form.fields.input type="password" label="Wachtwoord bevestiging" value=""
                    name="password_confirmation" required />
            </x-slot:fields>

            <x-slot:actions>
                <x-partials.buttons.primary as="button">Opslaan</x-partials.buttons.primary>
            </x-slot:actions>
        </x-partials.form.layouts.section>

        <x-partials.form.layouts.divider />

        <x-partials.form.layouts.section id="notification-section">
            <x-slot:description>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Notificaties</h3>
                <p class="mt-1 text-sm text-gray-600">Hier kun je instellen welke notificaties je wilt ontvangen en hoe.</p>
            </x-slot:description>

            <x-slot:fields>
                <x-partials.form.fields.radiobuttons.list label="Notificatie type"
                    description="Welk type notificaties wil je ontvangen?" required>
                    <x-partials.form.fields.radiobuttons.item name="notification_type" value="none" label="Geen" />
                    <x-partials.form.fields.radiobuttons.item name="notification_type" value="email" label="Email" />
                    <x-partials.form.fields.radiobuttons.item name="notification_type" value="sms" label="Phone (SMS)" />
                    <x-partials.form.fields.radiobuttons.item name="notification_type" value="push"
                        label="Push notification" />
                </x-partials.form.fields.radiobuttons.list>

                <x-partials.form.fields.checkboxes.list label="Notificatie soorten"
                    description="Van welke objecten wil je notificaties ontvangen?">
                    <x-partials.form.fields.checkboxes.item name="notification_objects[]" value="page" label="Pagina's" />
                    <x-partials.form.fields.checkboxes.item name="notification_objects[]" value="post" label="Posts" />
                    <x-partials.form.fields.checkboxes.item name="notification_objects[]" value="both"
                        label="Pagina's & Posts" />
                </x-partials.form.fields.checkboxes.list>
            </x-slot:fields>

            <x-slot:actions>
                <x-partials.buttons.primary as="button">Opslaan</x-partials.buttons.primary>
            </x-slot:actions>
        </x-partials.form.layouts.section>
    </x-partials.form>
@endsection
