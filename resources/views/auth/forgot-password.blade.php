<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <div class="mb-3">
                {{ __('¿Olvidaste tu password?, Coloca tu email de registro y te enviaremos un enlace para que puedas crear uno nuevo') }}
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-3" />

            <form method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <x-jet-label value="Email" />
                    <x-jet-input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" :value="old('email')" required autofocus />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <x-link :href="route('login')">
                            Iniciar Sesión
                        </x-link>

                        <x-link :href="route('register')">
                            Crear cuenta
                        </x-link>
                    </div>
                    
                    <div class="d-grid">
                        <x-jet-button class="mt-3">
                            Enviar Instrucciones
                        </x-jet-button>
                    </div>
                </div>

            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>