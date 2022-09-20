<div>

    @if (session()->has('mensaje'))
        <x-alert type="success">
            {{ session('mensaje'); }}
        </x-alert>                            
    @endif

    <div class="col-12">		
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">LA PLATAFORMA DE PAGO ESTÁ {{ $boolPago ? 'ACTIVADA' : 'DESACTIVADA'}}</legend>

        <div class="btn-group">
            <button 
                class="btn {{ $boolPago ? 'btn-danger' : 'btn-info'}}"
                wire:click.lazy="$emit('alertStatePay', {{ !$boolPago }} )">
                <strong>{{ $boolPago ? 'DESACTIVAR' : 'ACTIVAR'}}</strong>
            </button>
        </div>
      </fieldset>      
    </div>

    <div class="col-12">

      <h5>TIPOS DE ENTREGA</h5>

      @foreach ( $empresaEntrega as $entrega )

        <div 
            class="card mb-2"
            style="background-color: {{ $entrega->flag ? '#a3cfbb' : '#f1aeb5' }}">
            <div class="card-body">
            <h5 class="card-title">{{ $entrega->tipo_entrega->entrega }}</h5>
            <p class="card-text">{{ $entrega->detalle ? $entrega->detalle : $entrega->tipo_entrega->descripcion }}</p>
            <button 
                type="button" 
                class="btn {{ $entrega->flag ? 'btn-danger' : 'btn-success' }}"
                wire:click.lazy="$emit('alertEntrega', {{ $entrega }} )">
                {{ $entrega->flag ? 'DESACTIVAR' : 'ACTIVAR' }}
            </button>
            <button 
                type="button" 
                class="btn btn-info loading"
                wire:click="openMdlEntrega({{ $entrega }})">
                INFORMACIÓN
            </button>
            </div>
        </div>
          
      @endforeach

    </div>

    <div class="col-12 mt-5">

      <h5>TIPOS DE PAGO</h5>

      @foreach ( $empresaPago as $pago )

        <div 
            class="card mb-2"
            style="background-color: {{ $pago->flag ? '#a3cfbb' : '#f1aeb5' }}">
            <div class="card-body">
            <h5 class="card-title">{{ $pago->tipo_pago->pago }}</h5>
            <p class="card-text">{{ $pago->detalle ? $pago->detalle : $pago->tipo_pago->descripcion }}</p>
            <button 
                type="button" 
                class="btn {{ $pago->flag ? 'btn-danger' : 'btn-success' }}"
                wire:click.lazy="$emit('alertPago', {{ $pago }} )">
                {{ $pago->flag ? 'DESACTIVAR' : 'ACTIVAR' }}
            </button>
            <button 
                type="button" 
                class="btn btn-info loading"
                wire:click="openMdlPago({{ $pago }})">
                INFORMACIÓN
            </button>
            </div>
        </div>
          
      @endforeach

    </div>

    <livewire:tipo-pago-modal />

    @push('scripts')
        <script>
            $( ".loading" ).click(function() {
                Swal.showLoading();
            });
            window.addEventListener('openMdl', event => {
                $("#mdlTipoPago").modal('show');
                Swal.close();
            });
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on( 'alertStatePay', pay => {
                Swal.fire({
                    title: 'PLATAFORMA DE PAGO',
                    text: pay ? 'SE ACTIVARÁ LA PLATAFORMA DE PAGOS' : 'SE DESACTIVARÁ LA PLATAFORMA DE PAGOS',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: pay ? 'SI, ACTIVAR PAGO' : 'SI, DESACTIVAR PAGO',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('statePay');
                        Swal.fire({
                            title: 'PLATAFORMA DE PAGO',
                            text: pay ? 'LA PLATAFORMA DE PAGOS SE HA ACTIVADO EXITOSAMENTE' : 'LA PLATAFORMA DE PAGOS SE HA DESACTIVADO EXITOSAMENTE',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
            Livewire.on( 'alertEntrega', entrega => {
                Swal.fire({
                    title: 'TIPO DE ENTREGA',
                    text: entrega.flag == '0' ? 'SE ACTIVARÁ ESTE TIPO DE ENTREGA' : 'SE DESACTIVARÁ ESTE TIPO DE ENTREGA',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: entrega.flag == '0' ? 'SI, ACTIVAR' : 'SI, DESACTIVAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('stateEntrega', entrega );
                        Swal.fire({
                            title: 'TIPO DE ENTREGA',
                            text: entrega.flag == '0' ? 'EL TIPO DE ENTREGA SE HA ACTIVADO EXITOSAMENTE' : 'EL TIPO DE ENTREGA SE HA DESACTIVADO EXITOSAMENTE',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
            Livewire.on( 'alertPago', pago => {
                Swal.fire({
                    title: 'TIPO DE PAGO',
                    text: pago.flag == '0' ? 'SE ACTIVARÁ ESTE TIPO DE PAGO' : 'SE DESACTIVARÁ ESTE TIPO DE PAGO',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: pago.flag == '0' ? 'SI, ACTIVAR' : 'SI, DESACTIVAR',
                    cancelButtonText: 'CANCELAR',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('statePago', pago );
                        Swal.fire({
                            title: 'TIPO DE PAGO',
                            text: pago.flag == '0' ? 'EL TIPO DE PAGO SE HA ACTIVADO EXITOSAMENTE' : 'EL TIPO DE PAGO SE HA DESACTIVADO EXITOSAMENTE',
                            icon: 'success',
                            allowOutsideClick: false
                        });
                    }
                })
            });
        </script>
    @endpush

</div>
