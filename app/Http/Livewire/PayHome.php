<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PayHome extends Component
{
    public $planes;

    public function render()
    {
        return view('livewire.pay-home');
    }

    public function mount(){
        $this->planes = Plan::all();
    }

    public function openMdl(Plan $plan)
    {
        $this->emit('dataModal',$plan);
        $this->dispatchBrowserEvent('openMdl');
    }
}
