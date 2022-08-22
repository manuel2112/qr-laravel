<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <div class="mb-3 small text-muted">
                {{ __('Es necesario confirmar tu cuenta antes de continuar, revisa tu email y presiona sobre el enlace de confirmación.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('Hemos enviado un nuevo email de confirmación a la cuenta que colocaste en tu registro.') }}
                </div>
            @endif

            <div class="mt-4 d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-jet-button type="submit">
                            {{ __('Enviar email de confirmación') }}
                        </x-jet-button>
                    </div>
                </form>

                <form method="POST" action="{{ route("logout") }}">
                    @csrf

                    <button type="submit" class="btn btn-link">
                        {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>