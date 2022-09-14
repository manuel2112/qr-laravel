<div>
	<!--=====================================
	MODAL ADD PRODUCTO PASO 01
	======================================-->
    <div wire:ignore.self id="mdlProductoPaso01" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="goPaso2" novalidate>

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header">
                        <h4 class="modal-title">AGREGAR PRODUCTO EN: {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
                    
                    
                    <div class="modal-body">

                        <h3>PASO 1</h3>

                        <div class="mb-3">
                            <x-jet-label for="nombre" value="{{ __('Nombre') }}" />
                            <x-jet-input 
                                type="text"  
                                class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                placeholder="NOMBRE DEL PRODUCTO"
                                wire:model="nombre"
                                id="nombre"
                                :value="old('nombre')"
                                autocomplete="off"
                                required />
                            <x-jet-input-error for="nombre"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="detalle" value="{{ __('Detalle') }}" />
                            <textarea 
                                class="form-control form-control-lg"
                                placeholder="INGRESAR DETALLE...SE MOSTRARÁ EN LA VISTA PRINCIPAL DEL MENÚ" 
                                wire:model ="detalle"
                                id="detalle"
                                rows="3">{{ $detalle }}</textarea>
                            <x-jet-input-error for="detalle"></x-jet-input-error>
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="descripcion" value="{{ __('Descripción') }}" />
                            <textarea 
                                class="form-control form-control-lg"
                                placeholder="INGRESAR DESCRIPCIÓN...SE MOSTRARÁ EN LA VISTA INTERNA DEL PRODUCTO" 
                                wire:model ="descripcion"
                                id="descripcion"
                                rows="3">{{ $descripcion }}</textarea>
                            <x-jet-input-error for="descripcion"></x-jet-input-error>
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
                            PASO 2 <i class="fas fa-arrow-right"></i>
                        </x-jet-button>
                    </div>

                </form> 

			</div>

		</div>

	</div>

    <!--=====================================
	MODAL ADD PRODUCTO PASO 02
	======================================-->
    <div wire:ignore.self id="mdlProductoPaso02" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="goPaso3" novalidate>

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header">
                        <h4 class="modal-title">AGREGAR PRECIOS DE: {{ $nombre }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
                    
                    
                    <div class="modal-body">

                        <h3>PASO 2</h3>
                        <small class="help-block text-secondary">
                            CAMPOS DONDE SE INGRESARÁN EL/LOS VALORES DEL PRODUCTO.<br>
                            EL NOMBRE/VALOR BASE SERÁ EL PRINCIPAL.<br>
                            EL NOMBRE DEBE SER IDENTIFICATORIO (EJEMPLO LT, KG, PACK, ETC.)
                        </small>

                        <div class="mt-3 mb-1">
                            <x-jet-label for="0_nmbValor" value="{{ __('Nombre') }}" />
                                <div class="input-group">
                                    <x-jet-input 
                                        type="text" 
                                        class="form-control"
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
                                <span class="text-danger error">{{ $message }}</span> 
                            @enderror
                        </div>
                            
                        <div class="mb-3">
                            <x-jet-label for="0_precioValor" value="{{ __('Valor') }}" />
                                <div class="input-group">
                                    <x-jet-input 
                                        type="number" 
                                        class="form-control"
                                        placeholder="INGRESAR VALOR BASE"
                                        wire:model="precioValor.0"
                                        id="0_precioValor"
                                        autocomplete="off"
                                        onkeypress="return isNumber(event)"
                                        required />
                                </div>
                            @error('precioValor.0') 
                                <span class="text-danger error">{{ $message }}</span> 
                            @enderror
                        </div>

                        @foreach($inputs as $key => $value)

                            <div class="mb-1">
                                <x-jet-label for="{{$value}}_nmbValor" value="{{ __('Nombre') }}" />
                                    <div class="input-group">
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
                                <x-jet-input-error for="nmbValor.{{ $value }}"></x-jet-input-error>
                            </div>
                            
                            <div class="mb-3">
                                <x-jet-label for="{{$value}}_precioValor" value="{{ __('Valor') }}" />
                                    <div class="input-group">
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
                                <x-jet-input-error for="precioValor.{{ $value }}"></x-jet-input-error>
                            </div>

                        @endforeach
                        
                    
                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">
                        <x-jet-button type="button" class="btn btn-primary" wire:click="goPaso1">
                            <i class="fas fa-arrow-left"></i> PASO 1 
                        </x-jet-button>
                        <x-jet-button type="button" class="btn btn-secondary" wire:click="close">
                            Cerrar
                        </x-jet-button>
                        <x-jet-button class="btn btn-primary">
                            <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            PASO 3 <i class="fas fa-arrow-right"></i>
                        </x-jet-button>
                    </div>

                </form> 

			</div>

		</div>

	</div>

    <!--=====================================
	MODAL ADD PRODUCTO PASO 03
	======================================-->
    <div wire:ignore.self id="mdlProductoPaso03" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header">
                        <h4 class="modal-title">AGREGAR IMAGEN PRINCIPAL DE: <span id="title-producto"></span></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
                    
                    
                    <div class="modal-body">

                        <h3>PASO 3</h3>
                        <small class="help-block text-secondary">
                            IMAGEN PRINCIPAL DEL PRODUCTO, CAMPO OPCIONAL, AL SER CREADO EL PRODUCTO Y DEPENDIENDO DE TU MEMBRESÍA PODRÁS AGREGAR LAS SIGUIENTES IMÁGENES
                        </small>
                        
                        <div class="row">

                            <div class="col-12">

                                <div id="img-pro-ins-ok">
                                    <x-alert type="success">
                                        LA IMAGEN HA SIDO SELECCIONADA
                                    </x-alert>
                                </div>
                                
                                <x-jet-input 
                                    type="file"  
                                    class="{{ $errors->has('logotipo') ? 'is-invalid' : '' }}"
                                    id="imageProIns"
                                    accept="image/*"
                                    onchange="loadFileProIns(event)"
                                    hidden
                                    required />
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" id="buscarImagenProIns"><i class='fas fa-folder-open'></i>   BUSCAR IMAGEN </button>
                                </div>

                            </div>

                            <div class="col-12 text-center" id="btnsUpProIns">
                                        
                                <div class="btn-group my-3">

                                    <button type="button" class="btn btn-success upload-image-pro-ins"><i class="fa fa-upload"></i>
                                        SELECCIONAR
                                    </button>
                                    <button type="button" class="btn btn-warning" id="cut-pro-ins"><i class="fa fa-cut"></i>
                                        RECORTAR
                                    </button>
                                    <button type="button" class="btn btn-danger" id="del-pro-ins"><i class="fas fa-trash-alt"></i>
                                        ELIMINAR
                                    </button>
                                </div>

                                <br>
                                
                                <img id="upload-normal-pro-ins" />
                                <div id="upload-crop-pro-ins"></div>

                            </div>

                            <div class="col-12 text-center" id="img-pro-ins-select">
                                        
                                <div class="btn-group my-3">
                                    <button type="button" class="btn btn-danger" id="del-pro-ins-select"><i class="fas fa-trash-alt"></i>
                                        ELIMINAR
                                    </button>
                                </div>

                                <br>
                                
                                <img id="upload-select-pro-ins" />

                            </div>
                            
                        </div>
                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">
                        <x-jet-button type="button" class="btn btn-primary" wire:click="goPaso2">
                            <i class="fas fa-arrow-left"></i> PASO 2 
                        </x-jet-button>
                        <x-jet-button type="button" class="btn btn-secondary" wire:click="close">
                            Cerrar
                        </x-jet-button>
                        <form wire:submit.prevent="goPaso4(Object.fromEntries(new FormData($event.target)))">
                            <input type="hidden" name="imagen" id="path-img" />
                            <x-jet-button class="btn btn-primary">
                                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                PASO 4 <i class="fas fa-arrow-right"></i>
                            </x-jet-button>
                        </form>
                    </div>

                 

			</div>

		</div>

	</div>

	<!--=====================================
	MODAL ADD PRODUCTO PASO 04
	======================================-->
    <div wire:ignore.self id="mdlProductoPaso04" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="insertProducto" novalidate>

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header">
                        <h4 class="modal-title">SELECCIONAR OPCIONES PARA: {{ $nombre }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
                    
                    <div class="modal-body">

                        <h3 class="mb-4">PASO 4</h3>

                        <div class="row">
                            <div class="col-12">
                                <h4>¿DESEAS MOSTRAR EL DETALLE DEL PRODUCTO?</h4>							
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="btn-group mb-2">                                    
                                    <input type="radio" class="btn-check" wire:model="isLink" id="btnradio1" value="1">
                                    <label class="btn btn-outline-success" for="btnradio1">
                                        SI Mostrar Detalle
                                    </label> 

                                    <input type="radio" class="btn-check" wire:model="isLink" id="btnradio2" value="0">                                    
                                    <label class="btn btn-outline-danger" for="btnradio2">
                                        NO Mostrar Detalle
                                    </label>
                                </div>
                                @error('isLink')
                                    <br>
                                    <span class="text-danger fw-bold mx-3">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12">
                                <h4>¿DESEAS ACTIVAR ESTE PRODUCTO?</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="btn-group mb-2">
                                    <input type="radio" class="btn-check" wire:model="isShow" id="btnradio3" value="1">
                                    <label class="btn btn-outline-success" for="btnradio3">SI Activar</label>
                                  
                                    <input type="radio" class="btn-check" wire:model="isShow" id="btnradio4" value="0">
                                    <label class="btn btn-outline-danger" for="btnradio4">NO Activar</label>

                                    <x-jet-input-error for="isDetalle"></x-jet-input-error>
                                </div>
                                @error('isShow')
                                    <br>
                                    <span class="text-danger fw-bold mx-3">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">
                        <x-jet-button type="button" class="btn btn-primary" wire:click="goPaso3">
                            <i class="fas fa-arrow-left"></i> PASO 3 
                        </x-jet-button>
                        <x-jet-button type="button" class="btn btn-secondary" wire:click="close">
                            Cerrar
                        </x-jet-button>
                        <x-jet-button class="btn btn-primary">
                            <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            Ingresar Producto
                        </x-jet-button>
                    </div>

                </form>

			</div>

		</div>

	</div>    
    
    @push('scripts')
        <script>
            window.addEventListener('closeModals', event => {
                $("#mdlProductoPaso01").modal('hide');
                $("#mdlProductoPaso02").modal('hide');
                $("#mdlProductoPaso03").modal('hide');
                $("#mdlProductoPaso04").modal('hide');
            })
            window.addEventListener('mdlTo01', event => {
                $("#mdlProductoPaso01").modal('show');
                $("#mdlProductoPaso02").modal('hide');
            })
            window.addEventListener('mdlTo02', event => {
                $("#mdlProductoPaso01").modal('hide');
                $("#mdlProductoPaso02").modal('show');
                $("#mdlProductoPaso03").modal('hide');
            })
            window.addEventListener('mdlTo03', event => {
                $("#mdlProductoPaso02").modal('hide');
                $("#mdlProductoPaso03").modal('show');
                $("#mdlProductoPaso04").modal('hide');
            })
            window.addEventListener('mdlTo04', event => {
                $("#mdlProductoPaso03").modal('hide');
                $("#mdlProductoPaso04").modal('show');
            })
        </script>
        <script>
            function isNumber(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
        <script>

            let isNormalProIns;
            let tempNormalProIns;
            let resizeProIns;
            let imgProductoInsSelect = '';
            let crReload;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $( "#buscarImagenProIns" ).click(function() {
                document.getElementById('imageProIns').click();
            });
            
            window.addEventListener('instanciarProIns', e => {
                if( imgProductoInsSelect.length === 0 ){
                    insCroppieProIns();
                    insObjProIns();
                    crReload = false;
                    //PARAMEROS
                    $( "#title-producto" ).text( e.detail.nombre );
                }else{
                    showImgProSelect(imgProductoInsSelect);
                    $("#path-img").val(imgProductoInsSelect);
                    crReload = true;
                }
            });
            
            function insCroppieProIns(){
                resizeProIns = $('#upload-crop-pro-ins').croppie({
                    viewport: { width: 330, height: 330, type: 'square' },
                    boundary: { width: 360, height: 360 },
                    enableExif: true,
                    enableOrientation: true,
                    showZoomer: true,
                    enforceBoundary: false,
                });
            }

            function insObjProIns(){
                $( "#img-pro-ins-ok" ).css("display","none");
                $( "#img-pro-ins-select" ).css("display","none");
                $( "#btnsUpProIns" ).css("display","none");
                $( "#upload-normal-pro-ins" ).css("display","block");
                $( "#upload-crop-pro-ins" ).css("display","none");
                isNormalProIns          = true;
                tempNormalProIns        = '';
                imgProductoInsSelect    = '';
            }
            
            $( "#cut-pro-ins" ).click(function() {
                if( isNormalProIns ){
                    $( "#cut-pro-ins" ).text( "NORMAL" );
                    $( "#upload-normal-pro-ins" ).css("display","none");
                    $( "#upload-crop-pro-ins" ).css("display","block");                    
                    resizeProIns.croppie('bind', tempNormalProIns);
                }else{
                    $( "#cut-pro-ins" ).text( "RECORTAR" );
                    $( "#upload-normal-pro-ins" ).css("display","block");
                    $( "#upload-crop-pro-ins" ).css("display","none");
                }
                isNormalProIns = !isNormalProIns;
            });
            
            $( "#del-pro-ins" ).click(function() {
                insObjProIns();
            });
            
            $( "#del-pro-ins-select" ).click(function() {
                $( "#buscarImagenProIns" ).css({"display": "block", "margin-left": "auto", "margin-right": "auto"});
                insObjProIns();
                $("#path-img").val('');
                crReload ? insCroppieProIns() : '' ;
                crReload = false;
            });

            let loadFileProIns = function(event) {
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

                $( "#btnsUpProIns" ).css("display","block");
                var output = document.getElementById('upload-normal-pro-ins');
                $( "#upload-normal-pro-ins" ).addClass( ["img-thumbnail"] ).css({"width": "360", "margin-left": "auto", "margin-right": "auto"});
                const reader = new FileReader()
                const self = this
                reader.onload = function (e) {
                    tempNormalProIns = e.target.result;
                    resizeProIns.croppie('bind', tempNormalProIns);
                }
                reader.readAsDataURL(file);
                output.src = URL.createObjectURL(file);
                
            };

            function showImgProSelect(img){
                $( "#btnsUpProIns" ).css("display","none");
                $( "#buscarImagenProIns" ).css("display","none");
                $( "#img-pro-ins-ok" ).css("display","block");
                $( "#img-pro-ins-select" ).css("display","block");
                $( "#upload-select-pro-ins" ).addClass( ["img-thumbnail"] ).css({"width": "360", "margin-left": "auto", "margin-right": "auto"});
                $('#upload-select-pro-ins').attr('src', img);
                $("#path-img").val(img);
            }

            $('.upload-image-pro-ins').on('click', function (ev) {
                Swal.showLoading();
                resizeProIns.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (img) {
                    $.ajax({
                    url: '{{ route('menu.uploadproductoimg') }}',
                    type: "POST",
                    data: {"imageNormal":tempNormalProIns, "imageCrop":img, "isNormal":isNormalProIns},
                        success: function (data) {
                            imgProductoInsSelect = data.path;
                            showImgProSelect(imgProductoInsSelect);
                            Swal.close();
                        }
                    });
                });                
            });
        </script>
    @endpush

</div>
