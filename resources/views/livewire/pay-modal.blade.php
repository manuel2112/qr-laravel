<div>
    <div wire:ignore.self id="mdlPay" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form wire:submit.prevent="goPay" novalidate>

					<!--=====================================
					CABEZA DEL MODAL
					======================================-->

					<div class="modal-header">
						<h4 class="modal-title">CONTRATAR PLAN {{ $nombre }}</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!--=====================================
					CUERPO DEL MODAL
					======================================-->

                    <form wire:submit.prevent="goPay" novalidate>
                    
                        <div class="modal-body">
                            
                            <div class="p-3 mb-2 bg-secondary text-light">
                                <h2 class="text-center">VALOR MENSUAL {{ formatMoney($valor) }} + IVA </h2>
                            </div>

                            <div class="img-webpay d-flex justify-content-center mb-4">
                                <img src="<?php echo asset('images/img-webpay.png')?>" alt="" class="img-fluid" width="350">
                            </div>
                            
                            <input type="hidden" id="valor" value="{{ $valor }}">
                            {{-- <input type="hidden" name="cantMeses" :value=" cantMeses ">
                            
                            <input type="hidden" name="plan" :value=" membresia.MEMBRESIA_NOMBRE ">
                            <input type="hidden" name="idMembresia" :value=" membresia.MEMBRESIA_ID "> --}}

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-plus"></i></span>
                                    <select 
                                        class="form-control {{ $errors->has('meses') ? 'is-invalid' : '' }}"
                                        wire:model="meses"
                                        wire:change="calcMembresia">
                                        <option value="">SELECCIONAR MESES MEMBRESÍA (*)...</option>
                                        @while ( $initMeses <= $maxMeses)
                                            <option value="{{ $initMeses }}">{{ $initMeses++ }}</option>
                                        @endwhile
                                    </select>
                                </div>
                                @error('meses') 
                                    <span class="text-danger fw-bold">{{ $message }}</span> 
                                @enderror
                            </div>

                            @if ( $calculo )
                                {!! $calculo !!}
                            @endif

                            <div class="d-grid">
                                <x-jet-button class="btn btn-lg btn-primary btn-block">
                                    <div wire:loading class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <i class="far fa-credit-card"></i> PAGAR
                                </x-jet-button>
                            </div>

                        </div>

                    </form>

					<!--=====================================
					PIE DEL MODAL
					======================================-->

					<div class="modal-footer">
						<x-jet-button type="button" class="btn btn-secondary" wire:click="close">
                            Cerrar
                        </x-jet-button>
					</div>

				</form>

			</div>

		</div>

	</div>

    @push('scripts')
        <script>
            window.addEventListener('closeModal', event => {
                $("#mdlPay").modal('hide');
            })
        </script>
    @endpush
</div>
