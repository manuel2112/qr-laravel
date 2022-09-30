<?php

namespace App\Http\Livewire;

use App\Models\EmpresaPlan;
use Livewire\Component;

class MiPlanHome extends Component
{
    public $actual;
    public $contratados;
    public $vencidos;

    public function render()
    {
        return view('livewire.mi-plan-home');
    }

    public function mount(){

        $this->actual = EmpresaPlan::where([ 'user_id' => auth()->user()->id, 'en_uso' => TRUE ])->first();
        $this->contratados = EmpresaPlan::where([ 'user_id' => auth()->user()->id, 'flag' => TRUE, 'en_uso' => FALSE ])->orderBy('id', 'asc')->get();
        $this->vencidos = EmpresaPlan::where([ 'user_id' => auth()->user()->id, 'flag' => FALSE ])->orderBy('id', 'desc')->get();

    }
}
