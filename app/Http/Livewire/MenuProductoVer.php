<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;

class MenuProductoVer extends Component
{
    public $nombre;
    public $detalle;
    public $descripcion;
    public $valores  = [];
    public $imagenes = [];

    protected $listeners = ['dataModalProductoVer'];

    public function render()
    {
        return view('livewire.menu-producto-ver');
    }

    public function dataModalProductoVer(Producto $producto)
    {
        $this->nombre       = $producto->producto;
        $this->detalle      = $producto->detalle;
        $this->descripcion  = $producto->descripcion;
        $this->valores      = $producto->valores;
        $this->imagenes      = $producto->imagenes;
    }

    public function close()
    {
        $this->reset(['nombre','detalle','descripcion','valores','imagenes']);
    }
}
