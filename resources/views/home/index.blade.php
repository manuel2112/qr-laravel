<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Home') }}</li>
                <li class="breadcrumb-item"><a href="#" class="btn btn-outline-warning" target="_blank" style="font-size: 10px"><i class="fas fa-question"></i></a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center my-1">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-1 border-bottom rounded-top">
                    <div class="mx-3 my-1">

                        @if ( $aviso )
                            {!! $aviso !!}
                            <div class="text-center">
                                <a 
                                    href="#" 
                                    class="btn btn-danger">
                                    <strong>
                                        RENOVAR MEMBRESÍA
                                        <i class="fa fa-chevron-right"></i>
                                        <i class="fa fa-chevron-right"></i>
                                    </strong>
                                </a>
                            </div>                            
                        @endif
                    
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <img src="{{ asset($qr->qr) }}" alt="{{ $empresa->empresa }}" class="img-fluid w-100" />

                                @if ( $empresa->membresia )
                                    <div class="row justify-content-center">
                                        @if ( !$empresa->logotipo )
                                            <a 
                                                href="{{ route('empresa.index') }}"
                                                class="btn btn-primary btn-block btn-lg"
                                                v-if=" !empresa.EMPRESA_LOGOTIPO ">
                                                <strong>PERSONALIZA TU QR INGRESANDO TU LOGOTIPO AQUI</strong>
                                            </a>
                                            <br>
                                        @endif
                        
                                        <a 
                                            href="{{ asset('uploads/empresas/' . $qr->qr) }}" 
                                            target="_blank" 
                                            class="btn btn-primary btn-block btn-lg mt-4" 
                                            download>
                                            <strong>DESCARGA TU CÓDIGO QR AQUÍ</strong>
                                        </a>
                                    </div>                                  
                                @endif
                    
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>