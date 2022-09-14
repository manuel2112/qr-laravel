<div>

    @if (session()->has('mensaje'))
        <x-alert type="success">
            {{ session('mensaje'); }}
        </x-alert>                            
    @endif

    <div class="row">
        <div class="col-12">
            <div class="btn-group my-3 float-end">
                <button 
                    type="button" 
                    class="btn btn-primary" 
                    data-bs-toggle="modal" 
                    data-bs-target="#mdlOrderGrupos"
                    title="REORDENAR GRUPOS">
                    <i class="fas fa-bars"></i> ORDENAR GRUPOS
                </button>

                <button 
                    type="button" 
                    class="btn btn-primary" 
                    data-bs-toggle="modal" 
                    data-bs-target="#mdlInsertGrupo"
                    title="AGREGAR GRUPO">
                    <i class="fas fa-plus"></i> AGREGAR GRUPO
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @foreach ( $grupos as $grupo )
                <div class="card menu-card">
				
                    <div class="card-header">
                        {{ $grupo->grupo }}
                        <div class="btn-group">
    
                            <button 
                                type="button" 
                                class="btn btn-outline-primary loading"
                                wire:click="openMdlProductoAdd({{ $grupo }})"
                                title="AGREGAR PRODUCTO">
                                <i class="fas fa-plus"></i> PRODUCTO
                            </button>
    
                            <button 
                                type="button" 
                                class="btn btn-outline-primary"
                                wire:click="openMdlGrupoEdit({{ $grupo }})"
                                title="EDITAR GRUPO">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <button 
                                type= "button" 
                                class= "btn btn-outline-primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#mdlOrderProductos"  
                                title= "ORDENAR PRODUCTOS">
                                <i class="fas fa-arrows-alt"></i>
                            </button>
									
                            <button 
                                type="button" 
                                class="btn btn-outline-primary loading"
                                wire:click="openMdlGrupoImg({{ $grupo }})"
                                title="IMAGEN">
                                <i class="fas fa-images"></i>
                            </button>
                                
                            <button 
                                type= "button" 
                                class= "btn {{ $grupo->show ? 'btn-outline-primary' : 'btn-primary' }}"
                                title= "OCULTAR GRUPO"
                                wire:click.lazy="$emit('alertaGrupoShow', {{ $grupo->id }}, {{ $grupo->show }} )">
                                <i class="fas fa-eye-slash"></i>
                            </button>
    
                            <button 
                                type="button" 
                                class="btn btn-danger" 
                                title="ELIMINAR GRUPO"
                                wire:click="$emit('alertaGrupoDelete', {{ $grupo->id }}, '{{ $grupo->grupo }}' )">
                                <i class="fas fa-trash-alt"></i>
                            </button>
    
                        </div>
                    </div>

                    <table class="table table-hover">
                        <tbody>
                            @forelse ( $grupo->producto as $producto )
                                <tr>
                                    <th width="20%" style="padding-top: 15px">
                                        {{ $producto->producto }}
                                    </th>
                                    <th style="padding-top: 10px">
                                        <div class="btn-group">
        
                                            <button 
                                                type="button" 
                                                class="btn btn-outline-primary" 
                                                data-toggle="modal" 
                                                data-target="#mdlVerProducto" 
                                                title="VER PRODUCTO">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            
                                            <button 
                                                type="button" 
                                                class="btn btn-outline-primary" 
                                                data-toggle="modal" 
                                                data-target="#mdlEditProducto" 
                                                title="EDITAR PRODUCTO">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <button 
                                                type="button" 
                                                class="btn btn-outline-primary" 
                                                data-toggle="modal" 
                                                data-target="#mdlEditVP" 
                                                title="VARIACIÓN DE PRECIO">
                                                <i class="fas fa-dollar-sign"></i>
                                            </button>
                                            
                                            <button 
                                                type="button" 
                                                class="btn btn-outline-primary" 
                                                data-toggle="modal" 
                                                data-target="#mdlEditGaleria" 
                                                title="GALERÍA DE IMÁGENES">
                                                <i class="fas fa-images"></i>
                                            </button>
                                            
                                            <button 
                                                type= "button" 
                                                class= "btn {{ $producto->link ? 'btn-outline-primary' : 'btn-primary' }}"
                                                title= "MOSTRAR/OCULTAR DETALLE PRODUCTO"
                                                wire:click.lazy="$emit('alertaProductoLink', {{ $producto->id }}, {{ $producto->link }} )">
                                                <i class="fas fa-link"></i>
                                            </button>
        
                                            <button 
                                                type= "button" 
                                                class= "btn  {{ $producto->show ? 'btn-outline-primary' : 'btn-primary' }}" 
                                                title= "OCULTAR PRODUCTO"
                                                wire:click.lazy="$emit('alertaProductoShow', {{ $producto->id }}, {{ $producto->show }} )">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
        
                                            <button 
                                                type="button" 
                                                class="btn btn-danger" 
                                                title="ELIMINAR PRODUCTO"
                                                wire:click="$emit('alertaProductoDelete', {{ $producto->id }}, '{{ $producto->producto }}' )">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
        
                                        </div>
                                    </th>
                                </tr>
                            @empty
                                <p class="pt-3 px-3">SIN PRODUCTOS INGRESADOS</p>
                            @endforelse
                        </tbody>
                    </table>

                </div>                
            @endforeach
        </div>
    </div>
    
    <livewire:menu-add-grupo />
    <livewire:menu-order-grupo :grupos="$grupos" />
    <livewire:menu-grupo-edit />
    <livewire:menu-grupo-imagen />
    <livewire:menu-producto-add />

    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $( ".loading" ).click(function() {
                Swal.showLoading();
            });
            window.addEventListener('openMdlGrupoImg', event => {
                $("#mdlGrupoImg").modal('show');
                Swal.close();
            });
            window.addEventListener('openMdlGrupoEdit', event => {
                $("#mdlEditGrupo").modal('show');
                Swal.close();
            });
            window.addEventListener('openMdlProductoAdd', event => {
                $("#mdlProductoPaso01").modal('show');
                Swal.close();
            });
            window.addEventListener('closeModal', event => {
                $("#mdlGrupoImg").modal('hide');
                $("#mdlEditGrupo").modal('hide');
                $("#mdlProductoPaso01").modal('hide');
            });
        </script>
        <script>
            Livewire.on( 'alertaGrupoShow', (idGrupo,flag) => {
                Swal.fire({
                    title: flag ? 'OCULTAR GRUPO' : 'MOSTRAR GRUPO',
                    text: flag ? '¿ESTÁS SEGURO DE OCULTAR ESTE GRUPO?' : '¿ESTÁS SEGURO DE MOSTRAR ESTE GRUPO?' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: flag ? 'SI, OCULTAR' : 'SI,MOSTRAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('grupoShow', idGrupo, flag );
                        Swal.fire({
                            title: flag ? 'OCULTAR GRUPO' : 'MOSTRAR GRUPO',
                            text: flag ? 'EL GRUPO HA SIDO OCULTO CON ÉXITO' : 'EL GRUPO HA SIDO ACTIVADO CON ÉXITO',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
            Livewire.on( 'alertaGrupoDelete', (idGrupo,nombre) => {
                Swal.fire({
                    title: 'ELIMINAR GRUPO',
                    text: "¿ESTÁS SEGURO DE ELIMINAR ESTE GRUPO?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'SI, ELIMINAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('grupoDelete', idGrupo);
                        Swal.fire({
                            title: 'ELIMINADO',
                            text: `EL GRUPO ${nombre} HA SIDO ELIMINADO CON ÉXITO`,
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
            Livewire.on( 'alertaProductoLink', (idProducto,flag) => {
                Swal.fire({
                    title: 'DETALLE PRODUCTO',
                    text: flag ? 'ESTA ACCIÓN OCULTARÁ EL DETALLE DEL PRODUCTO' : 'ESTA ACCIÓN MOSTRARÁ EL DETALLE DEL PRODUCTO' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: flag ? 'SI, OCULTAR' : 'SI,MOSTRAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('productoLink', idProducto, flag );
                        Swal.fire({
                            title: 'DETALLE PRODUCTO',
                            text: flag ? 'SE MOSTRARÁ DETALLE DEL PRODUCTO' : 'NO SE MOSTRARÁ DETALLE DEL PRODUCTO',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
            Livewire.on( 'alertaProductoShow', (idProducto,flag) => {
                Swal.fire({
                    title: flag ? 'OCULTAR PRODUCTO' : 'MOSTRAR PRODUCTO',
                    text: flag ? '¿ESTÁS SEGURO DE OCULTAR ESTE PRODUCTO?' : '¿ESTÁS SEGURO DE MOSTRAR ESTE PRODUCTO?' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: flag ? 'SI, OCULTAR' : 'SI,MOSTRAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('productoShow', idProducto, flag );
                        Swal.fire({
                            title: flag ? 'OCULTAR PRODUCTO' : 'MOSTRAR PRODUCTO',
                            text: flag ? 'EL PRODUCTO HA SIDO OCULTO CON ÉXITO' : 'EL PRODUCTO HA SIDO ACTIVADO CON ÉXITO',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
            Livewire.on( 'alertaProductoDelete', (idProducto,nombre) => {
                Swal.fire({
                    title: 'ELIMINAR PRODUCTO',
                    text: "¿ESTÁS SEGURO DE ELIMINAR ESTE PRODUCTO?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'SI, ELIMINAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('productoDelete', idProducto);
                        Swal.fire({
                            title: 'ELIMINADO',
                            text: `EL PRODUCTO ${nombre} HA SIDO ELIMINADO EXITOSAMENTE`,
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
        </script>
    @endpush

</div>
