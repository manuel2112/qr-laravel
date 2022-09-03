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

                            <div class="col-12 text-center" id="btn-normal">
                                        
                                <div class="btn-group my-3">

                                    <button type="button" class="btn btn-success upload-image"><i class="fa fa-upload"></i>
                                         SUBIR</button>                                    
                                    <button type="button" class="btn btn-warning" id="cut"><i class="fa fa-cut"></i>
                                        RECORTAR</button>
                                </div>

                                <br>
                                
                                <img id="upload-normal" />
                                <div id="upload-crop"></div>

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

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@endpush

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script>
        
        $( "#buscarImagen" ).click(function() {
            document.getElementById('image').click();
        });

        //https://foliotek.github.io/Croppie/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( "#btn-normal" ).css("display","none");
        $( "#upload-normal" ).css("display","block");
        $( "#upload-crop" ).css("display","none");
        let isNormal    = true;
        let tempNormal  = '';
        let tempCrop    = '';
        $( "#cut" ).click(function() {
            if( isNormal ){
                $( "#cut" ).text( "NORMAL" );
                $( "#upload-normal" ).css("display","none");
                $( "#upload-crop" ).css("display","block");
                resize.croppie('bind', tempCrop);
            }else{
                $( "#cut" ).text( "RECORTAR" );
                $( "#upload-normal" ).css("display","block");
                $( "#upload-crop" ).css("display","none");
            }
            isNormal = !isNormal;
        });

        let loadFile = function(event) {
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
            
            $( "#btn-normal" ).css("display","block");
            var output = document.getElementById('upload-normal');
            $( "#upload-normal" ).addClass( ["img-thumbnail"] ).css({"width": "360", "margin-left": "auto", "margin-right": "auto"});
            const reader = new FileReader()
            const self = this
            reader.onload = function (e) {
                tempNormal = e.target.result;
            }
            reader.readAsDataURL(file);
            output.src = URL.createObjectURL(file);
            
        };
        
        let resize = $('#upload-crop').croppie({
            enableExif: true,
            enableOrientation: true,
            showZoomer: true,
            enforceBoundary: false,
            viewport: {
                width: 330,
                height: 330,
                type: 'square'
            },
            boundary: {
                width: 360,
                height: 360
            }
        });
        
        $('#image').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                tempCrop = e.target.result;
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        
        
        $('.upload-image').on('click', function (ev) {
            Swal.showLoading();
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                $.ajax({
                url: "{{route('empresa.uploadimage')}}",
                type: "POST",
                data: {"imageNormal":tempNormal, "imageCrop":img, "isNormal":isNormal},
                    success: function (data) {
                        window.location.href = data.url;
                        Swal.close();
                    }
                });
            });
            
        });
    </script>
    
@endpush
