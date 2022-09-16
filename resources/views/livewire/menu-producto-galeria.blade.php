<div>
	<!--=====================================
	MODAL EDIT VARIACIÓN DE PRODUCTO
	======================================-->
    <div wire:ignore.self id="mdlGaleriaProducto" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="editValores" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
                        <h4 class="modal-title">GALERÍA IMÁGENES DE: {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->
					
					<div class="modal-body">

                        <div class="row img-productos">
                            @foreach ( $imagenes as $imagen )
                                <div class="img-productos-box mb-3">
                                    <img src="{{ asset($imagen->img) }}" class="img-thumbnail"> <br>
                                    <div class="text-center">
                                        <button 
                                            type="button" 
                                            class="btn btn-danger"											
											wire:click="$emit('alertaDeleteImagen', {{ $imagen }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>                                
                            @endforeach
							<hr class="mt-3">
                        </div>						
					
						<div class="row mt-1">
							<div class="col-12">
								<span class="help-block text-secondary">3 IMÁGENES MÁXIMO</span><br>
								<span class="help-block text-secondary">TIENES INGRESADAS {{ count($imagenes) }} DE {{ $maxImg }}</span><br>
								<span class="help-block text-secondary">1 MB MÁXIMO POR IMAGEN</span><br>
								<span class="help-block text-secondary">JPG O PNG</span>
							</div>
						</div>

						<hr>
						
                        
                        <div class="row">

                            <div class="col-12">
                                
                                <x-jet-input 
                                    type="file"
                                    id="imageGaleriaIns"
                                    accept="image/*"
                                    onchange="loadFileGaleriaIns(event)"
                                    hidden
                                    required />
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" id="buscarImagenGaleriaIns"><i class='fas fa-folder-open'></i> BUSCAR IMAGEN</button>
                                </div>

                            </div>

                            <div class="col-12 text-center" id="btnsUpGaleriaIns">
                                        
                                <div class="btn-group my-3">

                                    <button type="button" class="btn btn-success upload-image-galeria-ins"><i class="fa fa-upload"></i>
                                        SUBIR
                                    </button>
                                    <button type="button" class="btn btn-warning" id="cut-galeria-ins"><i class="fa fa-cut"></i>
                                        RECORTAR
                                    </button>
                                    <button type="button" class="btn btn-danger" id="del-galeria-ins"><i class="fas fa-trash-alt"></i>
                                        BORRAR
                                    </button>
                                </div>

                                <br>
                                
                                <img id="upload-normal-galeria-ins" />
                                <div id="upload-crop-galeria-ins"></div>

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

    @push('scripts')

		<script>			
            Livewire.on( 'alertaDeleteImagen', imagen => {
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
                        Livewire.emit('deleteImagen', imagen);
                        Swal.fire({
                            title: 'ELIMINADO',
                            text: 'LA IMAGEN HA SIDO ELIMINADA EXITOSAMENTE',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
		</script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
        <script>

			let idProducto = '';
            let isNormalGaleriaIns;
            let resizeGaleriaIns;
            let tempNormalGaleriaIns;
            let browse = false;
			setBrowse(browse);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $( "#buscarImagenGaleriaIns" ).click(function() {
                document.getElementById('imageGaleriaIns').click();
            });

            window.addEventListener('instanciarGaleriaIns', e => {
				insCroppieGaleriaIns();
				insObjGaleriaIns();
				//PARAMEROS
				browse 		= e.detail.browse;
				idProducto 	= e.detail.idProducto;
				setBrowse(browse)
            });

			function setBrowse(value){
				let display = value ? "block" : "none" ;
				$( "#buscarImagenGaleriaIns" ).css({"display": display, "margin-left": "auto", "margin-right": "auto"});
			}
            
            function insCroppieGaleriaIns(){
                resizeGaleriaIns = $('#upload-crop-galeria-ins').croppie({
                    viewport: { width: 330, height: 330, type: 'square' },
                    boundary: { width: 360, height: 360 },
                    enableExif: true,
                    enableOrientation: true,
                    showZoomer: true,
                    enforceBoundary: false,
                });
            }

            function insObjGaleriaIns(){
                $( "#btnsUpGaleriaIns" ).css("display","none");
                $( "#upload-normal-galeria-ins" ).css("display","block");
                $( "#upload-crop-galeria-ins" ).css("display","none");
                isNormalGaleriaIns          = true;
                tempNormalGaleriaIns        = '';
                imgGaleriaductoInsSelect    = '';
            }
            
            $( "#cut-galeria-ins" ).click(function() {
                if( isNormalGaleriaIns ){
                    $( "#cut-galeria-ins" ).text( "NORMAL" );
                    $( "#upload-normal-galeria-ins" ).css("display","none");
                    $( "#upload-crop-galeria-ins" ).css("display","block");                    
                    resizeGaleriaIns.croppie('bind', tempNormalGaleriaIns);
                }else{
                    $( "#cut-galeria-ins" ).text( "RECORTAR" );
                    $( "#upload-normal-galeria-ins" ).css("display","block");
                    $( "#upload-crop-galeria-ins" ).css("display","none");
                }
                isNormalGaleriaIns = !isNormalGaleriaIns;
            });
            
            $( "#del-galeria-ins" ).click(function() {
                insObjGaleriaIns();
            });

            let loadFileGaleriaIns = function(event) {
                const titleAlert = "IMAGEN";
                const file = event.target.files[0];
                this.imgTemp = event.target.files[0];
                const type = file.type;
                const size = file.size;
                
                if ( !((type == 'image/jpeg') || (type == 'image/jpg') || (type == 'image/png')) ) {
                    Swal.fire({
                        title: titleAlert,
                        text: "FORMATOS SOPORTADOS PNG O JPG",
                        icon: 'error',
                        confirmButtonColor: '#0275d8',
                        allowOutsideClick: false
                    });
                    return;
                }
                if( (size / 1024) > 1024 ){
                    Swal.fire({
                        title: titleAlert,
                        text: "PESO MÁXIMO DE 1 MB SUPERADO",
                        icon: 'error',
                        confirmButtonColor: '#0275d8',
                        allowOutsideClick: false
                    });
                    return;
                }

                $( "#btnsUpGaleriaIns" ).css("display","block");
                var output = document.getElementById('upload-normal-galeria-ins');
                $( "#upload-normal-galeria-ins" ).addClass( ["img-thumbnail"] ).css({"width": "360", "margin-left": "auto", "margin-right": "auto"});
                const reader = new FileReader()
                const self = this
                reader.onload = function (e) {
                    tempNormalGaleriaIns = e.target.result;
                    resizeGaleriaIns.croppie('bind', tempNormalGaleriaIns);
                }
                reader.readAsDataURL(file);
                output.src = URL.createObjectURL(file);
                
            };

            $('.upload-image-galeria-ins').on('click', function (ev) {
                Swal.showLoading();
                resizeGaleriaIns.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (img) {
                    $.ajax({
                    url: '{{ route('menu.uploadgaleriaimg') }}',
                    type: "POST",
                    data: {"imageNormal":tempNormalGaleriaIns, "imageCrop":img, "isNormal":isNormalGaleriaIns, "idProducto":idProducto },
                        success: function (data) {
							//LIMPIAR PARAMETROS
							insObjGaleriaIns();

							//EMIT NUEVA DATA
							Livewire.emit('updateGaleria');

                            Swal.close();
                        }
                    });
                });                
            });
        </script>
    @endpush
</div>
