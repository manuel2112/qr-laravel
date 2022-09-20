<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EmpresaTipoPago;
use App\Models\EmpresaTipoEntrega;

class TipoPagoModal extends Component
{
    public $idTipo;
    public $title;
    public $informacion;
    public $tipo;

    protected $listeners = ['dataModalEntrega','dataModalPago'];

    public function render()
    {
        return view('livewire.tipo-pago-modal');
    }

    public function dataModalEntrega(EmpresaTipoEntrega $entrega)
    {
        $this->title        = $entrega->tipo_entrega->entrega;
        $this->informacion  = $entrega->detalle;
        $this->idTipo       = $entrega->id;
        $this->tipo         = 1;
    }
    
    public function dataModalPago(EmpresaTipoPago $pago)
    {
        $this->title        = $pago->tipo_pago->pago;
        $this->informacion  = $pago->detalle;
        $this->idTipo       = $pago->id;
        $this->tipo         = 2;
    }

    public function edit()
    {
        $this->informacion = $this->informacion ? $this->informacion : NULL;
        
        if( $this->tipo == 1 ){
            EmpresaTipoEntrega::where( 'id' ,$this->idTipo )->update([ 'detalle' => $this->informacion ]);
        }else{
            EmpresaTipoPago::where( 'id' ,$this->idTipo )->update([ 'detalle' => $this->informacion ]);
        }

        $texto = 'La información ha sido ingresado exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->reset(['title','informacion','idTipo','tipo']);
        $this->dispatchBrowserEvent('closeModal');
    }
}
