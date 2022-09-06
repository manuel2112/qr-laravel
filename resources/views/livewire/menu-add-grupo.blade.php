<div>
    <div wire:ignore.self id="mdlInsertGrupo" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="insertGrupo" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
						<h4 class="modal-title">AGREGAR GRUPO</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">	
						
						<div class="row">							
							<div class="col-12">
                                <div class="mb-3">
                                    <x-jet-label for="grupo" value="{{ __('Grupo') }}" />
                                    <x-jet-input 
                                        type="text"  
                                        class="{{ $errors->has('grupo') ? 'is-invalid' : '' }}"
                                        placeholder="INGRESAR GRUPO"
                                        wire:model="grupo"
                                        id="grupo"
                                        :value="old('grupo')" 
                                        required />
                                    <x-jet-input-error for="grupo"></x-jet-input-error>
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
                            Ingresar
                        </x-jet-button>
					</div>

				</form>

			</div>

		</div>

	</div>

    @push('scripts')
        <script>
            window.addEventListener('closeModal', event => {
                $("#mdlInsertGrupo").modal('hide');
            })
        </script>
    @endpush
</div>
