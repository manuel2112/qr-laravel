<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Empresa') }}</li>
                <li class="breadcrumb-item"><a href="#" class="btn btn-outline-warning" target="_blank" style="font-size: 10px"><i class="fas fa-question"></i></a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center my-1">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-1 border-bottom rounded-top">
                    <div class="mx-3 my-1">

                        @if (session()->has('mensaje'))
                            <x-alert type="success">
                                {{ session('mensaje'); }}
                            </x-alert>                            
                        @endif
		
                        <div class="col-12 text-center">
                            @if ( $empresa->logotipo )
                                <img src="{{ asset($empresa->logotipo) }}" class="img-thumbnail logo-perfil" width="auto">                                
                            @else
                                <img v-else src="{{ asset('images/default.png') }}" class="img-thumbnail" width="auto">                                
                            @endif
                            <br>
                            <a href="{{ urlQR().$empresa->slug }}" class="btn btn-primary mt-2" target="_blank">VER MENÚ</a>
                        </div>

                        <div class="col-12">

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">DATOS DE LA EMPRESA (* CAMPOS NO EDITABLES)</legend>
                                
                                <table class="table">
                                    <tr>
                                        <td class="table-primary" style="width:15%">NOMBRE</td>
                                        <td>{{ $empresa->empresa }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">DIRECCIÓN</td>
                                        <td>{{ $empresa->direccion }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">CIUDAD</td>
                                        <td>{{ $comuna->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">FONO</td>
                                        <td>{{ $empresa->fono }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">DESCRIPCIÓN</td>
                                        <td>{{ $empresa->descripcion }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">WHATSAPP</td>
                                        <td>{{ $empresa->whatsapp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">WEB</td>
                                        <td>{{ $empresa->web }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">FACEBOOK</td>
                                        <td>{{ $empresa->facebook }}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-primary">INSTAGRAM</td>
                                        <td>{{ $empresa->instagram }}</td>
                                    </tr>
                                </table>

                                @if ( $empresa->membresia )                
                                    <button 
                                        type="button"
                                        class="btn btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#mdlEditEmpresa">
                                        <strong>EDITAR DATOS DE LA EMPRESA</strong>
                                    </button>                                    
                                @else
                                    <a href="#" class="btn btn-danger" v-else>
                                        <strong>
                                            RENOVAR MEMBRESÍA 
                                            <i class="fa fa-chevron-right"></i>
                                            <i class="fa fa-chevron-right"></i>
                                        </strong>
                                    </a>
                                @endif
                
                            </fieldset>

                            <fieldset>
                                <legend>LOGOTIPO</legend>

                                @if ( $empresa->membresia )
                                    <button 
                                        class="btn btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#mdlEditLogo">
                                        <strong>EDITAR LOGOTIPO</strong>
                                    </button>                                  
                                @else
                                    <a href="#" class="btn btn-danger" v-else>
                                        <strong>
                                            RENOVAR MEMBRESÍA 
                                            <i class="fa fa-chevron-right"></i>
                                            <i class="fa fa-chevron-right"></i>
                                        </strong>
                                    </a>
                                @endif
                                
                            </fieldset>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:edit-empresa :empresa="$empresa" />
    <livewire:edit-logo :empresa="$empresa" />
  

</x-app-layout>