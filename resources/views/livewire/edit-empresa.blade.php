<div>
    
    <div wire:ignore.self id="mdlEditEmpresa" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
				<form wire:submit.prevent="editEmpresa" novalidate>

                    <div class="modal-header">
                        <h4 class="modal-title">
                            EDITAR DATOS DE LA EMPRESA<br />
                            <small>* Al cambiar el nombre de tu empresa, cambiarás la URL de tu menú.</small>
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <x-jet-label for="empresa" value="{{ __('NOMBRE EMPRESA') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('empresa') ? 'is-invalid' : '' }}"
                                placeholder="NOMBRE EMPRESA"
                                wire:model="empresa"
                                id="empresa"
                                :value="old('empresa', $empresa)" 
                                required />
                            <x-jet-input-error for="empresa"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="direccion" value="{{ __('DIRECCIÓN') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                placeholder="DIRECCIÓN"
                                wire:model="direccion"
                                id="direccion"
                                :value="old('direccion', $direccion)" 
                                required />
                            <x-jet-input-error for="direccion"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="region" value="{{ __('REGIÓN') }}" />
                            <select
                                class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}"
                                wire:model="region"
                                id="region">
                                
                                @foreach ( $regions as $region )
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                                
                            </select>
                            <x-jet-input-error for="region"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="ciudad" value="{{ __('CIUDAD') }}" />
                            <select
                                class="form-control {{ $errors->has('ciudad') ? 'is-invalid' : '' }}"
                                wire:model="ciudad"
                                id="ciudad">
            
                                <option value="">--SELECCIONA TU CIUDAD--</option>
                                @foreach ( $communes as $commune )
                                    <option value="{{ $commune->id }}">{{ $commune->name }}</option>                    
                                @endforeach
                                
                            </select>
                            <x-jet-input-error for="ciudad"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="telefono" value="{{ __('TELÉFONO') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                placeholder="TELÉFONO"
                                wire:model="telefono"
                                id="telefono"
                                :value="old('telefono', $telefono)" 
                                required />
                            <x-jet-input-error for="telefono"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="whatsapp" value="{{ __('WHATSAPP') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('whatsapp') ? 'is-invalid' : '' }}"
                                placeholder="WHATSAPP"
                                wire:model="whatsapp"
                                id="whatsapp"
                                :value="old('whatsapp', $whatsapp)" 
                                required />
                            <x-jet-input-error for="whatsapp"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="web" value="{{ __('SITIO WEB') }}" />
                            <x-jet-input 
                                type="web"  
                                class="{{ $errors->has('web') ? 'is-invalid' : '' }}"
                                placeholder="SITIO WEB (URL COMPLETA)"
                                wire:model="web"
                                id="web"
                                :value="old('web', $web)" 
                                required />
                            <x-jet-input-error for="web"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="facebook" value="{{ __('FACEBOOK') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                placeholder="FACEBOOK (URL COMPLETA)"
                                wire:model="facebook"
                                id="facebook"
                                :value="old('facebook', $facebook)" 
                                required />
                            <x-jet-input-error for="facebook"></x-jet-input-error>
                        </div>
                        
                        <div class="mb-3">
                            <x-jet-label for="instagram" value="{{ __('INSTAGRAM') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                placeholder="INSTAGRAM (URL COMPLETA)"
                                wire:model="instagram"
                                id="instagram"
                                :value="old('instagram', $instagram)" 
                                required />
                            <x-jet-input-error for="instagram"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="descripcion" value="{{ __('DESCRIPCIÓN') }}" />
                            <textarea 
                                class="form-control form-control-lg"
                                placeholder="DESCRIPCIÓN" 
                                wire:model ="descripcion"
                                id="descripcion"
                                rows="3">{{ $descripcion }}</textarea>
                            <x-jet-input-error for="descripcion"></x-jet-input-error>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <x-jet-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cerrar
                        </x-jet-button>
                        <x-jet-button class="btn btn-primary">
                            <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Editar
                        </x-jet-button>
                    </div>

                </form>            
            </div>
        </div>

    </div>

</div>
