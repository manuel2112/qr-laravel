<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\ProductoVariacion;

class MenuProductoValores extends Component
{
    public $idProducto;
    public $title;
    public $valores  = [];
    public $inputs = [];
    public $i;
    public $nmbValor;
    public $precioValor;
    public $count = 1;

    protected $listeners = ['dataModalProductoValores'];

    public function render()
    {
        return view('livewire.menu-producto-valores');
    }

    public function dataModalProductoValores(Producto $producto)
    {
        $this->idProducto   = $producto->id;
        $this->title        = $producto->producto;
        $this->valores      = $producto->valores;

        $this->instanciar();
    }

    public function instanciar()
    {
        $this->i = count($this->valores);
        for( $j = 0; $j < $this->i ; $j++){
            $this->nmbValor[$j] = $this->valores[$j]['nombre'];
            $this->precioValor[$j] = $this->valores[$j]['valor'];
            $j > 0 ? array_push($this->inputs , $j) : null;
        }
    }

    public function addInput($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function removeInput($key,$i)
    {
        unset($this->inputs[$key]);
        $this->nmbValor[$i] = null;
        $this->precioValor[$i] = null;
    }

    public function editValores()
    {
        $this->validate([
                'nmbValor.0'    => 'required|max:64',
                'precioValor.0' => 'required|numeric',
            ],
            [
                'nmbValor.0.required'       => 'Campo Nombre es requerido',
                'precioValor.0.numeric'     => 'Campo Valor debe ser numerico',
                'precioValor.0.required'    => 'Campo Valor es requerido',
            ]
        );

        //ELIMINAR EXISTENTES
        ProductoVariacion::where('producto_id', $this->idProducto)->update([ 'flag' => FALSE ]);        

        //INGRESAR NUEVOS VALORES
        foreach ($this->nmbValor as $key => $value) {

            if( (isset($this->nmbValor[$key]) && $this->nmbValor[$key] != '') && 
                (isset($this->precioValor[$key]) && is_numeric($this->precioValor[$key]) )  ){

                    $base = $key == 0 ? 1 : 0;

                    ProductoVariacion::create([
                        'producto_id'   => $this->idProducto,
                        'nombre'        => $this->nmbValor[$key],
                        'valor'         => $this->precioValor[$key],
                        'base'          => $base
                    ]); 
                    
            }
        }
        $texto = 'Valores editados exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->reset(['title','i','inputs', 'nmbValor', 'precioValor', 'valores']);
        $this->resetErrorBag();
        $this->emit('closeModals');
    }
}
