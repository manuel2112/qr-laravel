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
                <div class="card-body bg-white px-5 py-1 border-bottom rounded-top" id="pay">

                    @if ( !$compra )
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <strong><h4 class="text-center">SE HA PRODUCIDO UN ERROR, FAVOR VOLVER A INTENTAR<br>
                                <a href="{{ route('pay.index') }}">VOLVER</a></h4></strong>
                            </div>
                        </div>                        
                    @else
                        
                        <div class="well col-12">
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6">
                                    <address>
                                        <strong>FACILBAK QR</strong>
                                    </address>
                                </div>
                                <div class="col-6">
                                    <p class="text-end">
                                        <em>FECHA: {{ $time }}</em>
                                    </p>
                                    <p class="text-end">
                                        <em>N° ORDEN: {{ $compra->orden }}</em>
                                    </p>
                                </div>
                            </div>
                            <div class="row">

                                <h1 class="mb-3">PLAN A CONTRATAR</h1>
                                    
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>PLAN</th>
                                            <th>MESES</th>
                                            <th class="text-center">VALOR</th>
                                            <th class="text-center">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-9"><em>{{ $plan->plan }}</em></h4></td>
                                            <td class="col-md-1" style="text-align: center">{{ $compra->meses }}</td>
                                            <td class="col-md-1 text-center">{{ formatMoney($plan->valor) }}</td>
                                            <td class="col-md-1 text-right">{{ formatMoney($compra->total) }}</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="text-center">
                                                <p>
                                                    <strong>SUBTOTAL: </strong>
                                                </p>
                                                <p>
                                                    <strong>IVA: </strong>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <p>
                                                    <strong>{{ formatMoney($compra->neto) }}</strong>
                                                </p>
                                                <p>
                                                    <strong>{{ formatMoney($compra->iva) }}</strong>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td class="text-right"><h4><strong>TOTAL: </strong></h4></td>
                                            <td class="text-right text-danger"><h4><strong>{{ formatMoney($compra->total) }}</strong></h4></td>
                                        </tr>
                                    </tbody>
                                </table>
            
                                <form action="{{ $url_to_pay }}" method="POST" style="width:100%" class="mt-3">
                                    <input type="hidden" name="token_ws" value="{{ $token }}">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            PAGAR AHORA <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>