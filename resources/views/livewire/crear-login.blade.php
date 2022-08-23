<div>
    <x-jet-validation-errors class="mb-3 rounded-0" />

    @if (session('status'))
        <div class="alert alert-success mb-3 rounded-0" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form novalidate>
        @csrf
        <div class="mb-3">
            <x-jet-label value="{{ __('Email') }}" />

            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                         wire:model="email" :value="old('email')" required />
            <x-jet-input-error for="email"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label value="{{ __('Password') }}" />

            <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                         wire:model="password" required autocomplete="current-password" />
            <x-jet-input-error for="password"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <x-jet-checkbox id="remember_me" wire:model="remember" />
                <label class="custom-control-label" for="remember_me">
                    {{ __('Recordarme') }}
                </label>
            </div>
        </div>

        <div class="mb-0">
            <div class="d-flex justify-content-between align-items-baseline">
                <x-link :href="route('register')">
                    Crear cuenta
                </x-link>

                <x-link :href="route('password.request')">
                    ¿Olvidaste tu contraseña?
                </x-link>
            </div>
            
            <div class="d-grid">
                <x-jet-button class="mt-3">
                    Iniciar Sesión
                </x-jet-button>
            </div>
        </div>
    </form>
</div>
