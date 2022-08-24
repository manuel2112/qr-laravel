<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <h1>Registro</h1>
            <livewire:crear-registro />
        </div>
    </x-jet-authentication-card>
</x-guest-layout>