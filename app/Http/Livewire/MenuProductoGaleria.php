<?php

namespace App\Http\Livewire;

use App\Models\EmpresaPlan;
use Livewire\Component;
use App\Models\Producto;
use App\Models\ProductoImagen;

class MenuProductoGaleria extends Component
{
    public $idProducto;
    public $imagenes = [];
    public $title;
    public $maxImg = 1;

    protected $listeners = ['dataModalProductoGaleria', 'updateGaleria', 'deleteImagen'];

    public function render()
    {
        return view('livewire.menu-producto-galeria');
    }

    public function dataModalProductoGaleria(Producto $producto)
    {
        $this->idProducto   = $producto->id;
        // $this->imagenes     = $producto->imagenes;
        $this->title        = $producto->producto;
        $this->planActual();
        $this->emitInstancia();
    }

    function updateGaleria() {        
        $this->getImages($this->maxImg);
        $this->emitInstancia();
    }

    function planActual() {
        $plan = EmpresaPlan::where(['user_id' => auth()->user()->id, 'flag' => TRUE])->orderBy('id', 'asc')->first();
        $this->maxImg = $plan->plan->img;
        $this->getImages($this->maxImg);
    }

    function getImages($max) {
        $this->imagenes = ProductoImagen::where(['producto_id' => $this->idProducto, 'flag' => TRUE])->skip(0)->take($max)->orderBy('id', 'asc')->get();
    }

    function deleteImagen(ProductoImagen $imagen) {
        ProductoImagen::where('id', $imagen->id)->update([ 'flag' => FALSE ]);
        $this->getImages($this->maxImg);
        $this->emitInstancia();
    }

    function emitInstancia() {

        $browse = count($this->imagenes) < $this->maxImg ? TRUE :FALSE;
        $this->dispatchBrowserEvent('instanciarGaleriaIns', [
            'nombre'        => $this->title,
            'idProducto'    => $this->idProducto,
            'browse'        => $browse
        ]);
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->emit('closeModals');
        $this->reset(['idProducto','title','imagenes']);
        $this->resetErrorBag();
    }
}
