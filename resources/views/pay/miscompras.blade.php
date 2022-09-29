<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('pay.index') }}">{{ __('Centro de Pagos') }}</a></li>
                <li class="breadcrumb-item active">Mis Compras</li>
                <li class="breadcrumb-item"><a href="#" class="btn btn-outline-warning" target="_blank" style="font-size: 10px"><i class="fas fa-question"></i></a></li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center my-1">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-1 border-bottom rounded-top" id="pagos">

                    @if ( count($compras) == 0 )

                        <h3 class="text-center m-5">AÚN NO HAS REALIZADO COMPRAS</h3>
                        
                    @else

                        <div class="table-responsive">
                            <table class="table table-bordered table-dark table-hover mt-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ORDEN DE COMPRA</th>
                                        <th scope="col">PLAN</th>
                                        <th scope="col">CANTIDAD</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col">FECHA</th>
                                        <th scope="col">EXPORTAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ( $compras as $compra )
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $compra->orden }}</td>
                                            <td>{{ $compra->plan->plan }}</td>
                                            <td>{{ $compra->meses }}</td>
                                            <td>{{ formatMoney($compra->total) }}</td>
                                            <td>{{ Carbon\Carbon::parse($compra->created_at)->format('d-m-Y H:i') }}</td>
                                            <td><a href="{{ route('pdf.pago', [ 'id' => $compra->id ]) }}" target="_blank" class="btn btn-primary"><i class="far fa-file-pdf"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>