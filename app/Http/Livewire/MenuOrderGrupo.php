<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;

class MenuOrderGrupo extends Component
{
    public $grupos;
    public $key;
    public $order;

    protected $listeners = ['reorder'];

    public function render()
    {
        return view('livewire.menu-order-grupo');
    }

    public function mount(){
    }

    public function orderGrupo(){
        $i = 1;
        foreach( $this->grupos as $grupo ){
            Grupo::where( 'id' ,$grupo['id'])->update([ 'order' => $i ]);
            $i++;
        }
        $texto = 'Grupos ordenados exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    public function reorder($orderedIds){
        
        $this->grupos = collect($orderedIds)->map( function ($id) {
            return collect($this->grupos)->where('id', (int) $id['value'])->first();
        })->toArray();

    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->dispatchBrowserEvent('closeModal');
    }


}
