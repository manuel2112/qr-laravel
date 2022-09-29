<div>

    <div class="col-12" id="contacto">
    
      <form wire:submit.prevent="sendForm" novalidate class="my-5">

        <div class="mb-3">
            <x-jet-label for="asunto" value="{{ __('ASUNTO') }}" />
            <select
                class="form-control {{ $errors->has('asunto') ? 'is-invalid' : '' }}"
                wire:model="asunto"
                id="asunto">

                <option value="">--SELECCIONAR ASUNTO--</option>
                @foreach ( $contacto as $c )
                    <option value="{{ $c->id }}">{{ $c->subject }}</option>                    
                @endforeach
                
            </select>
            @error('asunto') 
                <span class="text-danger fw-bold">{{ $message }}</span> 
            @enderror
        </div>

        @if ( $descripcion )
            <div class="alert alert-info">
                <strong>{{ $descripcion }}</strong>
            </div>
        @endif

        <div class="mb-3">
            <x-jet-label for="mensaje" value="{{ __('MENSAJE') }}" />
            <textarea 
                class="form-control form-control-lg {{ $errors->has('mensaje') ? 'is-invalid' : '' }}"
                placeholder="MENSAJE" 
                wire:model.lazy ="mensaje"
                id="mensaje"
                rows="5">{{ $mensaje }}</textarea>
                @error('mensaje') 
                    <span class="text-danger fw-bold">{{ $message }}</span> 
                @enderror
        </div>
              
        <div class="d-grid">          
            <x-jet-button class="btn btn-primary">
                <div wire:loading class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                Enviar
            </x-jet-button>
        </div>

        @if ( $show )
            @if ( $success )
                <div class="alert alert-success mt-3">
                    <h2 class="text-center"><strong>Mensaje enviado exitosamente<br>Pronto nos contactaremos contigo.</strong></h2>
                </div>            
            @else
                <div class="alert alert-danger mt-3">
                    <h2 class="text-center"><strong>Se ha producido un error<br> favor volver a intentar.</strong></h2>
                </div>            
            @endif            
        @endif

      </form>

    </div>

</div>
