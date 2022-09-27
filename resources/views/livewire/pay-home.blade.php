<div>

    <h1>PLANES</h1>

    <div class="row">
        <div class="col-12">
            <p>*Servicio de administración: Como sabemos que tu tiempo vale oro, te ofrecemos el servicio para que no te preocupes de la administración de tu menú, solo debes indicarnos los cambios a realizar o agregar y lo haremos por ti.</p>
        </div>
    </div>

    <div class="row">

        @foreach ( $planes as $plan )
            @if ( $plan->id != 1 )

                <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{ $plan->plan }}</h4>
                            <small>-- {{ $plan->legend }} --</small>
                        </div>						
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">{{ formatMoney($plan->valor) }}<small class="text-muted">+IVA / mes</small></h1>

                            <ul class="list-unstyled mt-3 mb-4">
                                <li><i class="fa fa-check text-success"></i> {{ $plan->qr }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->panel }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->categorias }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->productos }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->con_img }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->img }} {{ $plan->max_img }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->url }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->redes }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->update }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->vistas }} {{ $plan->visual }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->tecnico }}</li>
                                @if ( $plan->admin )
                                    <li><i class="fa fa-check text-success"></i> {{ $plan->admin }}</li>                                                    
                                @else
                                    <li>&nbsp;</li>                                                    
                                @endif
                            </ul>
                            <div class="d-grid gap-2">
                                <button 
                                    type="button" 
                                    class="btn btn-lg btn-primary loading"
                                    wire:click="openMdl({{ $plan }})">
                                    CONTRATAR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endif                            
        @endforeach

        @foreach ( $planes as $plan )
            @if ( $plan->id == 1 )

                <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{ $plan->plan }}</h4>
                            <small>-- {{ $plan->legend }} --</small>
                        </div>						
                        <div class="card-body bg-bronce">
                            <h1 class="card-title pricing-card-title">GRATIS</h1>

                            <ul class="list-unstyled mt-3 mb-4">
                                <li><i class="fa fa-check text-success"></i> {{ $plan->qr }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->img }} {{ $plan->max_img }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->url }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->vistas }} {{ $plan->visual }}</li>
                                <li><i class="fa fa-check text-success"></i> {{ $plan->tecnico }}</li>
                                <li>&nbsp;</li>
                            </ul>
                            <div class="d-grid gap-2">
                                <button 
                                    type="button" 
                                    class="btn btn-lg btn-light"
                                    disabled>
                                    GRATIS
                                </button> 
                            </div>
                        </div>
                    </div>
                </div>
                
            @endif                            
        @endforeach

    </div>

    <livewire:pay-modal />

    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $( ".loading" ).click(function() {
                Swal.showLoading();
            });
            window.addEventListener('openMdl', event => {
                $("#mdlPay").modal('show');
                Swal.close();
            });
        </script>
    @endpush

</div>
