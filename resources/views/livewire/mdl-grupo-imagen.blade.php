
    <div wire:ignore.self id="mdlGrupoImg" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h4 class="modal-title">IMAGEN PRINCIPAL DEL GRUPO {{ $title }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                
                <div class="modal-body">
                    <form wire:submit.prevent="editLogo" novalidate>
                    
                        <div class="row">

                            <div class="col-12">

                                @if ( $imagen )
                                    <div class="text-center">
                                        
                                        <div class="btn-group my-3">                                        
                                            <button 
                                                type="button" 
                                                class="btn btn-danger"
                                                wire:click="$emit('mostrarAlerta', {{ $idGrupo }})">
                                                <i class="fas fa-trash-alt"></i> ELIMINAR
                                            </button>
                                        </div>

                                        <br>

                                        <img 
                                            src="{{ asset($imagen) }}" 
                                            class="img-thumbnail"
                                            width="360">

                                    </div>
                                @else                                
                                    <x-jet-input 
                                        type="file"  
                                        class="{{ $errors->has('logotipo') ? 'is-invalid' : '' }}"
                                        id="image"
                                        accept="image/*"
                                        onchange="loadFile(event)"
                                        hidden
                                        required />
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" id="buscarImagen"><i class='fas fa-folder-open'></i>   BUSCAR IMAGEN </button>
                                    </div>

                                @endif

                            </div>

                            <div class="col-12 text-center" id="btnsUp" style="display: none">
                                        
                                <div class="btn-group my-3">

                                    <button type="button" class="btn btn-success upload-image"><i class="fa fa-upload"></i>
                                        SUBIR</button>                                    
                                    <button type="button" class="btn btn-warning" id="cut"><i class="fa fa-cut"></i>
                                        RECORTAR</button>
                                </div>

                                <br>
                                
                                <img id="upload-normal" />
                                <div id="grupo-crop">xxx</div>

                            </div>
                            
                        </div>

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


    @push('scripts')        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
        <script>

        </script>
    @endpush