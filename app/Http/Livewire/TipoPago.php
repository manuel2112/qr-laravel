<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;
use App\Models\TipoEntrega;
use App\Models\EmpresaTipoPago;
use App\Models\EmpresaTipoEntrega;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoPago as ModelsTipoPago;

class TipoPago extends Component
{
    public $boolPago;
    public $empresaPago;
    public $empresaEntrega;

    protected $listeners = ['statePay','stateEntrega','statePago','reRenderParent','showMessage'];

    public function render()
    {
        return view('livewire.tipo-pago');
    }

    public function mount()
    {
        $empresa = Empresa::where(['user_id' => auth()->user()->id])->first();
        $this->boolPago = $empresa->pago;

        $this->empresaPago = EmpresaTipoPago::where(['user_id' => auth()->user()->id])->get();
        $this->empresaEntrega = EmpresaTipoEntrega::where(['user_id' => auth()->user()->id])->get();
        
        //INSTANCIAR SI NO EXISTEN
        if( count($this->empresaPago) == 0 ){
            $this->instanciarPago();
        }
        if( count($this->empresaEntrega) == 0 ){
            $this->instanciarEntrega();
        }
    }

    public function statePay()
    {
        $this->boolPago = !$this->boolPago;
        Empresa::where( 'user_id' ,auth()->user()->id )->update([ 'pago' => $this->boolPago ]);
    }

    public function stateEntrega(EmpresaTipoEntrega $entrega)
    {
        EmpresaTipoEntrega::where( 'id' ,$entrega->id )->update([ 'flag' => !$entrega->flag ]);
        $this->empresaEntrega = EmpresaTipoEntrega::where(['user_id' => auth()->user()->id])->get();
    }

    public function statePago(EmpresaTipoPago $entrega)
    {
        EmpresaTipoPago::where( 'id' ,$entrega->id )->update([ 'flag' => !$entrega->flag ]);
        $this->empresaPago = EmpresaTipoPago::where(['user_id' => auth()->user()->id])->get();
    }

    public function openMdlEntrega(EmpresaTipoEntrega $entrega)
    {
        $this->emit('dataModalEntrega',$entrega);
        $this->dispatchBrowserEvent('openMdl');
    }

    public function openMdlPago(EmpresaTipoPago $pago)
    {
        $this->emit('dataModalPago',$pago);
        $this->dispatchBrowserEvent('openMdl');
    }

    public function instanciarPago()
    {
        $pagos = ModelsTipoPago::all();
        foreach( $pagos as $pago ){
            EmpresaTipoPago::create([
                'tipo_pago_id'  => $pago->id,
                'user_id'       => Auth::id()
            ]);
        }
        $this->empresaPago = EmpresaTipoPago::where(['user_id' => auth()->user()->id])->get();
    }

    public function instanciarEntrega()
    {
        $entregas = TipoEntrega::all();
        foreach( $entregas as $entrega ){
            EmpresaTipoEntrega::create([
                'tipo_entrega_id'   => $entrega->id,
                'user_id'           => Auth::id()
            ]);
        }
        $this->empresaEntrega = EmpresaTipoEntrega::where(['user_id' => auth()->user()->id])->get();
    }

    public function reRenderParent()
    {
        $this->empresaPago      = EmpresaTipoPago::where(['user_id' => auth()->user()->id])->get();
        $this->empresaEntrega   = EmpresaTipoEntrega::where(['user_id' => auth()->user()->id])->get();
    }
    
    public function showMessage($texto)
    {
        session()->flash('mensaje',$texto);
    }
}
