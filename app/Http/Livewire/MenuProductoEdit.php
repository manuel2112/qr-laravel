<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class MenuProductoEdit extends Component
{
    public $idProducto;
    public $title;
    public $nombre;
    public $detalle;
    public $descripcion;

    protected $listeners = ['dataModalProductoEdit'];

    protected $rules = [
        'nombre' => 'required|string|max:64'
    ];

    public function render()
    {
        return view('livewire.menu-producto-edit');
    }

    public function dataModalProductoEdit(Producto $producto)
    {
        $this->idProducto   = $producto->id;
        $this->title        = $producto->producto;
        $this->nombre       = $producto->producto;
        $this->detalle      = $producto->detalle;
        $this->descripcion  = $producto->descripcion;
    }

    public function editProducto()
    {
        $this->validate();

        Producto::where('id', $this->idProducto)
                ->update([ 
                        'producto'      => $this->nombre,
                        'detalle'       => $this->detalle,
                        'descripcion'   => $this->descripcion
                    ]);

        $texto = 'Producto actualizado exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->reset(['title']);
        $this->emit('closeModals');
    }
}
