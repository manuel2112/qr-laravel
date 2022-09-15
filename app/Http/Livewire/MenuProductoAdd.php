<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Empresa;
use Livewire\Component;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use App\Models\ProductoVariacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuProductoAdd extends Component
{
    public $title;
    public $idGrupo;
    public $nombre;
    public $detalle;
    public $descripcion;
    public $inputs = [];
    public $i = 1;
    public $nmbValor;
    public $precioValor;
    public $imagen;
    public $isLink;
    public $isShow;

    protected $listeners = ['dataModalProductoAdd'];

    public function render()
    {
        return view('livewire.menu-producto-add');
    }

    public function dataModalProductoAdd(Grupo $grupo)
    {
        $this->idGrupo  = $grupo->id;
        $this->title    = $grupo->grupo;
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
    
    public function goPaso1()
    {
        $this->dispatchBrowserEvent('mdlTo01');        
    }

    public function goPaso2()
    {
        Validator::make(
            ['nombre' => $this->nombre],
            ['nombre' => 'required|string|max:64']
        )->validate();

        $this->dispatchBrowserEvent('mdlTo02');
    }

    public function goPaso3()
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

        $this->dispatchBrowserEvent('mdlTo03');
        $this->dispatchBrowserEvent('instanciarProIns', [
            'nombre'    => $this->nombre
        ]);
    }

    public function goPaso4($formData)
    {
        $this->imagen = $formData['imagen'];
        $this->dispatchBrowserEvent('mdlTo04');
    }

    public function insertProducto()
    {
        $this->validate([
                'isShow' => 'required',
                'isLink'    => 'required'
            ],
            [
                'isShow.required' => 'Seleccionar detalle',
                'isLink.required'    => 'Seleccionar link'
            ]
        );

        //INGRESAR PRODUCTO
        $producto = Producto::create([
            'grupo_id'      => $this->idGrupo,
            'producto'      => $this->nombre,
            'detalle'       => $this->detalle,
            'descripcion'   => $this->descripcion,
            'link'          => $this->isLink,
            'show'          => $this->isShow
        ]);

        //VARIACION DE VALORES
        foreach ($this->nmbValor as $key => $value) {

            if( (isset($this->nmbValor[$key]) && $this->nmbValor[$key] != '') && 
                (isset($this->precioValor[$key]) && is_numeric($this->precioValor[$key]) )  ){

                    $base = $key == 0 ? 1 : 0;

                    ProductoVariacion::create([
                        'producto_id'   => $producto->id,
                        'nombre'        => $this->nmbValor[$key],
                        'valor'         => $this->precioValor[$key],
                        'base'          => $base
                    ]); 
                    
            }

        }

        //IMAGEN
        if( $this->imagen ){
            
            $pathTh     = public_path($this->imagen );

            $idUser  = Auth::id();
            $empresa = Empresa::where(['user_id' => $idUser])->first();

            $folder = 'producto';
            $path = uploadImage($pathTh, $empresa->id, FALSE, $folder, $producto->id, TRUE);

            ProductoImagen::create([
                'producto_id'   => $producto->id,
                'img'           => $path
            ]);

        }

        $texto = 'El producto ha sido ingresado exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->reset(['nombre','detalle','descripcion','nmbValor','precioValor','imagen','isLink','isShow']);
        $this->dispatchBrowserEvent('closeModals');
    }
}
