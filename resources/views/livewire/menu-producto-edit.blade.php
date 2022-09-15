<div>
    <div wire:ignore.self id="mdlEditProducto" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="editProducto" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
						<h4 class="modal-title">EDITAR PRODUCTO: {{ $title }}</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">	
						
						<div class="row">							
							<div class="col-12">
                                <div class="mb-3">
                                    <x-jet-label for="editar-nombre-producto" value="{{ __('PRODUCTO') }}" />
                                    <x-jet-input 
                                        type="text"  
                                        class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                        placeholder="EDITAR PRODUCTO"
                                        wire:model="nombre"
                                        id="editar-nombre-producto"
                                        :value="old('nombre', $nombre)" 
                                        required />
                                    <x-jet-input-error for="nombre"></x-jet-input-error>
                                </div>

                                <div class="mb-3">
                                    <x-jet-label for="editar-detalle-producto" value="{{ __('DETALLE') }}" />
                                    <textarea 
                                        class="form-control form-control-lg"
                                        placeholder="DETALLE" 
                                        wire:model ="detalle"
                                        id="editar-detalle-producto"
                                        rows="3">{{ $detalle }}</textarea>
                                    <x-jet-input-error for="detalle"></x-jet-input-error>
                                </div>

                                <div class="mb-3">
                                    <x-jet-label for="editar-descripcion-producto" value="{{ __('DESCRIPCIÓN') }}" />
                                    <textarea 
                                        class="form-control form-control-lg"
                                        placeholder="DESCRIPCIÓN" 
                                        wire:model ="descripcion"
                                        id="editar-descripcion-producto"
                                        rows="3">{{ $descripcion }}</textarea>
                                    <x-jet-input-error for="descripcion"></x-jet-input-error>
                                </div>
							</div>
						</div>
					
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
	
</div>
