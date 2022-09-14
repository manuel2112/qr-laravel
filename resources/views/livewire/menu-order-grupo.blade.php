<div papipa>
    <div wire:ignore.self id="mdlOrderGrupos" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="orderGrupo" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
						<h4 class="modal-title">ORDENAR GRUPOS</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">
						
						<div class="row">							
							<div class="col-12">
                                <div>
                                    <ul wire:sortable="reorder" class="list-group">
                                        @foreach ( $grupos as $grupo )
                                            <li wire:sortable.item="{{ $grupo['id'] }}" draggable="true" class="list-group-item d-flex justify-content-between">
                                                {{ $grupo['grupo'] }} <i class="fas fa-arrows-alt"></i></i>
                                            </li>
                                        @endforeach
                                    </ul>
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
                            Ordenar
                        </x-jet-button>
					</div>

				</form>

			</div>

		</div>

	</div>
    
    @push('scripts')
        <script>
            window.addEventListener('closeModal', event => {
                $("#mdlOrderGrupos").modal('hide');
            })
        </script>
        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    @endpush
</div>
