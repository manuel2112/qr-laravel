<div>
    
    <form wire:submit.prevent="crearRegistro" novalidate>

        <div class="mb-3">
            <x-jet-label for="empresa" value="{{ __('Empresa') }}" />
            <x-jet-input 
                type="text"  
                class="{{ $errors->has('empresa') ? 'is-invalid' : '' }}"
                placeholder="NOMBRE DE TU EMPRESA"
                wire:model="empresa"
                id="empresa"
                :value="old('empresa')" 
                required 
                autofocus />
            <x-jet-input-error for="empresa"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label for="responsable" value="{{ __('Responsable') }}" />
            <x-jet-input 
                type="text"  
                class="{{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                placeholder="NOMBRE RESPONSABLE"
                wire:model="responsable"
                id="responsable"
                :value="old('responsable')" 
                required />
            <x-jet-input-error for="responsable"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label for="direccion" value="{{ __('Dirección') }}" />
            <x-jet-input 
                type="text"  
                class="{{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                placeholder="DIRECCIÓN DE TU EMPRESA (OPCIONAL)"
                wire:model="direccion"
                id="direccion"
                :value="old('direccion')" 
                required />
            <x-jet-input-error for="direccion"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label for="region" value="{{ __('Región') }}" />
            <select
                class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}"
                wire:model="region"
                id="region">

                <option value="">--SELECCIONA TU REGIÓN--</option>
                @foreach ( $regions as $region )
                    <option value="{{ $region->id }}">{{ $region->name }}</option>                    
                @endforeach
                
            </select>
            <x-jet-input-error for="region"></x-jet-input-error>
        </div>

        @if (!is_null($ciudades))
            <div class="mb-3">
                <x-jet-label for="ciudad" value="{{ __('Ciudad') }}" />
                <select
                    class="form-control {{ $errors->has('ciudad') ? 'is-invalid' : '' }}"
                    wire:model="ciudad"
                    id="ciudad">

                    <option value="">--SELECCIONA TU CIUDAD--</option>
                    @foreach ( $ciudades as $ciudad )
                        <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>                    
                    @endforeach
                    
                </select>
                <x-jet-input-error for="ciudad"></x-jet-input-error>
            </div>            
        @endif

        <div class="mb-3">
            <x-jet-label for="telefono" value="{{ __('Teléfono (9 Dígitos)') }}" />
            <x-jet-input 
                type="text"  
                class="{{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                placeholder="INGRESA TU TELÉFONO"
                wire:model="telefono"
                id="telefono"
                :value="old('telefono')" 
                required 
                autofocus />
            <x-jet-input-error for="telefono"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input 
                type="email"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                placeholder="INGRESA TU EMAIL"
                wire:model="email"
                id="email"
                :value="old('email')" 
                required />
            <x-jet-input-error for="email"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input 
                type="password" 
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="INGRESA TU PASSWORD"
                wire:model="password"
                id="password" 
                required />
            <x-jet-input-error for="password"></x-jet-input-error>
        </div>

        <div class="mb-3">
            <x-jet-label for="password_confirmation" value="{{ __('Repetir Password') }}" />
            <x-jet-input 
                type="password"  
                class="form-control"
                placeholder="REPETIR PASSWORD" 
                wire:model="password_confirmation" 
                id="password_confirmation"
                required />
        </div>

        <div class="mb-3">
            <x-jet-label for="cuentanos" value="{{ __('¿Cómo nos conociste?') }}" />
            <select
                class="form-control {{ $errors->has('cuentanos') ? 'is-invalid' : '' }}"
                wire:model="cuentanos"
                id="cuentanos">

                <option value="">--CUÉNTANOS CÓMO NOS CONOCISTE--</option>
                <option value="REFERIDO">POR UN REFERIDO (TE INVITARON A INGRESAR)</option>
                <option value="SITIO WEB">SITIO WEB</option>
                <option value="GOOGLE">GOOGLE</option>
                <option value="MAILLING">MAILLING</option>
                <option value="REDES SOCIALES">REDES SOCIALES</option>
                
            </select>
            <x-jet-input-error for="cuentanos"></x-jet-input-error>
        </div>        

        @if ( $isReferido )
            <div class="mb-3">
                <x-jet-label for="referido" value="{{ __('Referido') }}" />
                <x-jet-input 
                    type="text"  
                    class="{{ $errors->has('referido') ? 'is-invalid' : '' }}"
                    placeholder="NOMBRE DE QUIÉN TE REFIRIÓ"
                    wire:model="referido"
                    id="referido"
                    :value="old('referido')" 
                    required />
                <x-jet-input-error for="referido"></x-jet-input-error>
            </div>            
        @endif

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mb-3">
                <div class="custom-control custom-checkbox">
                    <x-jet-checkbox id="terms" name="terms" />
                    <label class="custom-control-label" for="terms">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                            ]) !!}
                    </label>
                </div>
            </div>
        @endif

        <div class="mb-0">
            <div class="d-flex justify-content-between align-items-baseline">
                <x-link :href="route('login')">
                    Iniciar Sesión
                </x-link>

                <x-link :href="route('password.request')">
                    ¿Olvidaste tu contraseña?
                </x-link>
            </div>
            
            <div class="d-grid mt-5">
                <x-jet-button class="mt-3 w-full">
                    Crear Cuenta
                </x-jet-button>
            </div>
        </div>
    </form>
</div>
