<div>
	<!--=====================================
	MODAL EDIT VARIACIÓN DE PRODUCTO
	======================================-->
    <div wire:ignore.self id="mdlValorProducto" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="editValores" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
                        <h4 class="modal-title">VARIACIÓN DE PRECIO: {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">

                        <div class="mt-3 mb-1">
                            <x-jet-label for="0_nmbValor" value="{{ __('Nombre') }}" />
                                <div class="input-group">
                                    <span class="input-group-text">{{ $count }}</span>
                                    <x-jet-input 
                                        type="text" 
                                        class="form-control {{ $errors->has('nmbValor.0') ? 'is-invalid' : '' }}"
                                        placeholder="INGRESAR NOMBRE BASE"
                                        wire:model="nmbValor.0"
                                        id="0_nmbValor"
                                        autocomplete="off" 
                                        required />
                                    <button 
                                        type="button" 
                                        class="btn btn-xs btn-primary" 
                                        title="AGREGAR VARIACIÓN DE PRODUCTO"
                                        wire:click.prevent="addInput({{$i}})">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            @error('nmbValor.0') 
                                <span class="text-danger fw-bold">{{ $message }}</span> 
                            @enderror
                        </div>
                            
                        <div class="mb-3">
                            <x-jet-label for="0_precioValor" value="{{ __('Valor') }}" />
                                <div class="input-group">
                                    <span class="input-group-text">{{ $count }}</span>
                                    <x-jet-input 
                                        type="number" 
                                        class="form-control {{ $errors->has('precioValor.0') ? 'is-invalid' : '' }}"
                                        placeholder="INGRESAR VALOR BASE"
                                        wire:model="precioValor.0"
                                        id="0_precioValor"
                                        autocomplete="off"
                                        onkeypress="return isNumber(event)"
                                        required />
                                </div>
                            @error('precioValor.0') 
                                <span class="text-danger fw-bold">{{ $message }}</span> 
                            @enderror
                        </div>

                        @foreach($inputs as $key => $value)
                            @php $count++ @endphp

                            <div class="mb-1">
                                <x-jet-label for="{{$value}}_nmbValor" value="{{ __('Nombre') }}" />
                                <div class="input-group">
                                    <span class="input-group-text">{{ $count }}</span>
                                    <x-jet-input 
                                        type="text" 
                                        class="form-control"
                                        placeholder="INGRESAR NOMBRE"
                                        wire:model="nmbValor.{{ $value }}"
                                        id="{{$value}}_nmbValor"
                                        autocomplete="off"
                                        required />                                        
                                    <button 
                                        type="button" 
                                        class="btn btn-xs btn-danger" 
                                        title="ELIMINAR VARIACIÓN DE PRODUCTO"
                                        wire:click.prevent="removeInput({{$key}},{{$value}})"
                                        v-else>
                                        <i class="fas fa-trash-alt"></i>
                                    </button> 
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <x-jet-label for="{{$value}}_precioValor" value="{{ __('Valor') }}" />
                                <div class="input-group">
                                    <span class="input-group-text">{{ $count }}</span>
                                    <x-jet-input 
                                        type="number" 
                                        class="form-control"
                                        placeholder="INGRESAR VALOR"
                                        wire:model="precioValor.{{ $value }}"
                                        id="{{$value}}_precioValor"
                                        onkeypress="return isNumber(event)"
                                        autocomplete="off"
                                        required />
                                </div>
                            </div>

                        @endforeach
					
					</div>

					<!--=====================================
					PIE DEL MODAL
					======================================-->

					<div class="modal-footer">
						<x-jet-button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="close">
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

    @push('scripts')
        <script>
            function isNumber(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
        </script>
    @endpush
</div>
