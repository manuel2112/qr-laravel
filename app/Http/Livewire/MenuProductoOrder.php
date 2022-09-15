<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Producto;
use Livewire\Component;

class MenuProductoOrder extends Component
{
    public $title;
    public $productos= [];

    protected $listeners = ['dataModalProductoOrder'];

    public function render()
    {
        return view('livewire.menu-producto-order');
    }

    public function dataModalProductoOrder(Grupo $grupo)
    {
        $this->title     = $grupo->grupo;
        $this->productos = $grupo->producto;
    }

    public function orderProducto(){
        $i = 1;
        foreach( $this->productos as $producto ){
            Producto::where( 'id' ,$producto['id'] )->update([ 'order' => $i ]);
            $i++;
        }
        $texto = 'Productos ordenados exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    public function reorder($orderedIds){
        
        $this->productos = collect($orderedIds)->map( function ($id) {
            return collect($this->productos)->where('id', (int) $id['value'])->first();
        })->toArray();

    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->reset(['productos']);
        $this->dispatchBrowserEvent('closeModal');
    }
}
