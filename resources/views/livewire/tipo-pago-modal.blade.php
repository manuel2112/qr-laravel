<div>
    <div wire:ignore.self id="mdlTipoPago" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="edit" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
						<h4 class="modal-title">EDITAR INFORMACIÓN: {{ $title }}</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">

						<div class="row">							
							<div class="col-12">

                                <div class="mb-3">
                                    <x-jet-label for="editar-informacion" value="{{ __('INFORMACIÓN') }}" />
                                    <textarea 
                                        class="form-control form-control-lg"
                                        placeholder="INFORMACIÓN" 
                                        wire:model ="informacion"
                                        id="editar-informacion"
                                        rows="3">xxx</textarea>
                                    <x-jet-input-error for="informacion"></x-jet-input-error>
                                </div>

							</div>
						</div>

					</div>

					<!--=====================================
					PIE DEL MODAL
					======================================-->

					<div class="modal-footer">
						<x-jet-button type="button" class="btn btn-secondary loading" wire:click="close">
                            Cerrar
                        </x-jet-button>						
                        <x-jet-button class="btn btn-primary loading">
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
            $( ".loading" ).click(function() {
                Swal.showLoading();
            });
            window.addEventListener('closeModal', event => {
                $("#mdlTipoPago").modal('hide');
                Swal.close();
            })
        </script>
    @endpush

</div>
