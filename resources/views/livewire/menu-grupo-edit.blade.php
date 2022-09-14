<div>
    <div wire:ignore.self id="mdlEditGrupo" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="editGrupo" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
						<h4 class="modal-title">EDITAR GRUPO {{ $title }}</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">	
						
						<div class="row">							
							<div class="col-12">
                                <div class="mb-3">
                                    <x-jet-label for="nombre" value="{{ __('Grupo') }}" />
                                    <x-jet-input 
                                        type="text"  
                                        class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                        placeholder="EDITAR GRUPO"
                                        wire:model="nombre"
                                        id="nombre"
                                        :value="old('nombre', $nombre)" 
                                        required />
                                    <x-jet-input-error for="nombre"></x-jet-input-error>
                                </div>
							</div>
						</div>
					
					</div>

					<!--=====================================
					PIE DEL MODAL
					======================================-->

					<div class="modal-footer">
						<x-jet-button type="button" class="btn btn-secondary" wire:click="close">
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
