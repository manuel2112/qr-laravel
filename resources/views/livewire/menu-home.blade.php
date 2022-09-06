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
                                class="btn btn-outline-primary" 
                                data-toggle="modal" 
                                data-target="#mdlProductoPaso01" 
                                title="AGREGAR PRODUCTO" 
                                @click=" instanciarInsertProducto(grupo.GRUPO) ">
                                <i class="fas fa-plus"></i> PRODUCTO
                            </button>
    
                            <button 
                                type="button" 
                                class="btn btn-outline-primary" 
                                data-toggle="modal" 
                                data-target="#mdlEditGrupo" 
                                title="EDITAR GRUPO" 
                                @click=" instanciarEditGrupo(grupo.GRUPO) ">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <button 
                                type= "button" 
                                class= "btn btn-outline-primary" 
                                data-toggle="modal" 
                                data-target="#mdlOrderProductos"  
                                title= "ORDENAR PRODUCTOS" 
                                @click= " asignarProductos(grupo.GRUPO,grupo.PRODUCTOS) "
                                v-if=" grupo.COUNT_PRODUCTOS > 1 ">
                                <i class="fas fa-arrows-alt"></i>
                            </button>
                                
                            <button 
                                type= "button" 
                                class= "btn" 
                                :class= " grupo.GRUPO.GRUPO_SHOW == 1 ? 'btn-outline-primary' : 'btn-primary' " 
                                title= "OCULTAR GRUPO" 
                                @click= " hideGrupo(grupo.GRUPO) ">
                                <i class="fas fa-eye-slash"></i>
                            </button>
    
                            <button 
                                type="button" 
                                class="btn btn-danger" 
                                title="ELIMINAR GRUPO" 
                                @click=" deleteGrupo(grupo.GRUPO) ">
                                <i class="fas fa-trash-alt"></i>
                            </button>
    
                        </div>
                    </div>

                </div>                
            @endforeach
        </div>
    </div>
    
    <livewire:menu-add-grupo />
    <livewire:menu-order-grupo :grupos="$grupos" />

</div>
