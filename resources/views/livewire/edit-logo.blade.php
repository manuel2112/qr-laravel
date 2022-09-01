<div>
    
    <div wire:ignore.self id="mdlEditLogo" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header">
					<h4 class="modal-title">
						{{ $empresa->empresa }} LOGOTIPO
					</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->
			
				<div class="modal-body">
                    <form wire:submit.prevent="editLogo" novalidate>
					
                        <div class="row">

                            <div class="col-12">

                                @if ( $empresa->logotipo )                                
                                    <div class="text-center">
                                        
                                        <div class="btn-group my-3">                                        
                                            <button 
                                                type="button" 
                                                class="btn btn-danger"
                                                wire:click="$emit('mostrarAlerta', {{ $empresa->id }})">
                                                <i class="fas fa-trash-alt"></i> ELIMINAR
                                            </button>
                                        </div>

                                        <br>

                                        <img 
                                            src="{{ asset($empresa->logotipo) }}" 
                                            class="img-thumbnail"
                                            width="360">

                                    </div>                                    
                                @else

                                    <x-jet-label for="logotipo" value="{{ __('Logotipo') }}" />
                                    <x-jet-input 
                                        type="file"  
                                        class="{{ $errors->has('logotipo') ? 'is-invalid' : '' }}"
                                        wire:model="logotipo"
                                        id="logotipo"
                                        accept="image/*"
                                        required />
                                    <x-jet-input-error for="logotipo"></x-jet-input-error>
                                    
                                @endif
                                
                                {{-- <div class="form-group" v-if=" !empresa.EMPRESA_LOGOTIPO ">
                                    <input
                                        type="file"
                                        class="form-control-file img-logo"
                                        id="insert-logo"
                                        @change=" loadImg "
                                        accept="image/*" />
                                </div> --}}

                            </div>

                            <div class="col-12">

                                {{-- <div class="text-center my-3" v-if=" empresa.EMPRESA_LOGOTIPO ">

                                    <button 
                                        type="button" 
                                        class="btn btn-danger" 
                                        @click=" deleteLogotipo() ">
                                        <i class="fas fa-trash-alt"></i> ELIMINAR
                                    </button>
                                    <br>									
                                    <img 
                                        :src=" empresa.EMPRESA_LOGOTIPO " 
                                        class="img-thumbnail" 
                                        :width="widthResize">
                                </div> --}}

                            </div>
                            
                            <div class="col-12">
                                @if ( $logotipo )
                                
                                    <div class="text-center">
                                        
                                        <div class="btn-group my-3">
                                            <x-jet-button class="btn btn-success">
                                                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                Subir
                                            </x-jet-button>
                                            
                                            <button 
                                                type="button" 
                                                class="btn btn-warning"
                                                @click=" cutImgTemp(cutBool,'#cut-add-logotipo') ">
                                                <i class="fas fa-cut"></i> RECORTAR
                                            </button>
                                            
                                            <button 
                                                type="button" 
                                                class="btn btn-danger"
                                                @click=" deleteImgTemp() ">
                                                <i class="fas fa-trash-alt"></i> ELIMINAR
                                            </button>
                                        </div>

                                        <br>

                                        <img 
                                            src="{{ $logotipo->temporaryUrl() }}" 
                                            class="img-thumbnail"
                                            id="cut-add-logotipo"
                                            width="360">

                                    </div>
                                    
                                @endif

                            </div>
                            
                        </div><!-- PIE ROW -->

                    </form>
				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">
					<x-jet-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </x-jet-button>
				</div>

			</div>

		</div>

	</div>

</div>

@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        Livewire.on( 'mostrarAlerta', idEmpresa => {
            Swal.fire({
                title: 'ELIMINAR IMAGEN',
                text: "¿ESTÁS SEGURO DE ELIMINAR ESTA IMAGEN?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, ELIMINAR',
                cancelButtonText: 'CANCELAR',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteLogotipo', idEmpresa);
                    $('#mdlEditLogo').modal('hide');
                    Swal.fire({
                        title: 'ELIMINADO',
                        text: 'LA IMAGEN HA SIDO ELIMINADA CON ÉXITO',
                        icon: 'success',
                        allowOutsideClick: false
                    });
                }
            })
        });        
    </script>
    
@endpush
