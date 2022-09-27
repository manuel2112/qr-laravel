<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Compra;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PayModal extends Component
{
    public $plan;
    public $idPlan;
    public $nombre;
    public $valor;
    public $meses;
    public $calculo = '';
    public $initMeses = 1;
    public $maxMeses = 24;
    public $neto;
    public $iva;
    public $total;

    protected $rules = [
        'meses' => 'required'
    ];

    protected $listeners = ['dataModal'];

    public function render()
    {
        return view('livewire.pay-modal');
    }

    public function dataModal(Plan $plan)
    {
        $this->plan      = $plan;
        $this->idPlan    = $plan->id;
        $this->nombre    = $plan->plan;
        $this->valor     = $plan->valor;
    }

    public function calcMembresia()
    {
        $this->neto       = $this->meses * $this->valor ;
        $this->iva        = $this->neto * (iva() / 100);
        $this->total      = $this->neto + $this->iva;

        $this->calculo = '<div class="alert alert-success"><h4 class="text-center">POR PAGAR: '.formatMoney($this->neto).' + IVA <br> TOTAL: '.formatMoney($this->total).'</h4></div>';
    }

    public function goPay()
    {
        $this->validate();

        $compra = Compra::create([
            'user_id'    => Auth::id(),
            'plan_id'    => $this->idPlan,
            'meses'      => $this->meses,
            'neto'       => $this->neto,
            'iva'        => $this->iva,
            'total'      => $this->total,
            'orden'      => time(),
            'session_id' => 'FBQR-' . time()
        ]);

        return Redirect::route('pay.pay')->with( ['compra' => $compra, 'plan' => $this->plan ] );
    }

    public function close()
    {
        $this->resetErrorBag();
        $this->reset(['nombre','valor','meses','calculo']);
        $this->dispatchBrowserEvent('closeModal');
    }
}
