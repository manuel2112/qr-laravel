<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __('Centro de Pagos') }}</li>
                <li class="breadcrumb-item"><a href="#" class="btn btn-outline-warning" target="_blank" style="font-size: 10px"><i class="fas fa-question"></i></a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center my-1">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-1 border-bottom rounded-top" id="pagos">

                    @if ( $request->token_ws )
                        @if ( $response->status == 'AUTHORIZED' )
                            <div class="col-12">
                                <div class="alert alert-success">
                                    <strong><h4 class="text-center">PAGO REALIZADO CON ÉXITO,<br> DESCARGA TU COMPROBANTE <br>
                                    <a href="{{ route('pdf.pago', [ 'id' => $response->buyOrder ]) }}">AQUÍ</a></h4></strong>
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <strong><h4 class="text-center">SE HA RECHAZADO TU COMPRA, NO SE HAN REALIZADO CARGOS A SU TARJETA, FAVOR VOLVER A INTENTAR<br>
                                    <a href="{{ route('pay.index') }}">VOLVER</a></h4></strong>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <strong><h4 class="text-center">SE HA PRODUCIDO UN ERROR,NO SE HAN REALIZADO CARGOS A SU TARJETA, FAVOR VOLVER A INTENTAR<br>
                                <a href="{{ route('pay.index') }}">VOLVER</a></h4></strong>
                            </div>
                        </div>                        
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>