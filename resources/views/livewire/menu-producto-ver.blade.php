<div>
    <div wire:ignore.self id="mdlVerProducto" class="modal modal-lg fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header">
					<h4 class="modal-title">PRODUCTO: {{ $nombre }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->
				
				<div class="modal-body">	
					
					<div class="row">				
						
						<div class="col-12">

						<table class="table">
							<tr>
								<td class="table-primary" style="width:15%">PRODUCTO</td>
								<td>{{ $nombre }}</td>
							</tr>
							<tr>
								<td class="table-primary">DETALLE*</td>
								<td>{{ $detalle }}</td>
							</tr>
							<tr>
								<td class="table-primary">DESCRIPCIÓN**</td>
								<td>{{ $descripcion }}</td>
							</tr>
						</table>
						<small>
							* SE MOSTRARÁ EN LA VISTA PRINCIPAL DEL MENÚ <br>
							** SE MOSTRARÁ EN LA VISTA INTERNA DEL PRODUCTO
						</small>						

						<fieldset class="scheduler-border">
							<legend class="scheduler-border">PRECIO(S)</legend>
							
							<table class="table">
                                @foreach ( $valores as $valor )
                                    <tr>
                                        <td class="table-primary" style="width:15%">{{ $valor->nombre }}</td>
                                        <td>{{ formatMoney($valor->valor) }}</td>
                                    </tr>
                                @endforeach
							</table>

						</fieldset>

						<fieldset class="scheduler-border" v-if=" productoGetImgs.length > 0">
							<legend class="scheduler-border">IMÁGENES</legend>

							<div class="row">
                                @foreach ( $imagenes as $imagen )
                                    <div>
                                        <img 
                                            src="{{ asset($imagen->img) }}" 
                                            class="img-thumbnail" 
                                            width="150" />									
                                    </div>
                                @endforeach
							</div>

						</fieldset>

						</div>

					</div><!-- PIE ROW -->
				
				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

                <div class="modal-footer">
                    <x-jet-button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="close">
                        Cerrar
                    </x-jet-button>
                </div>

			</div>

		</div>

	</div>
</div>
