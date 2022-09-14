<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;

class MenuGrupoImagen extends Component
{
    public $imagen;
    public $title;
    public $idGrupo;

    protected $listeners = ['dataModalGrupo', 'deleteImg', 'updateImg' ];

    public function render()
    {
        return view('livewire.menu-grupo-imagen');
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->emit('closeModals');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function dataModalGrupo(Grupo $grupo)
    {
        $this->idGrupo  = $grupo->id;
        $this->imagen   = $grupo->img ? asset($grupo->img) : NULL;
        $this->title    = $grupo->grupo;
        $this->dispatchBrowserEvent('instanciar', [
            'nombre'    => $this->title,
            'ruta'      => $this->imagen
        ]);
    }

    public function deleteImg()
    {
        Grupo::where( 'id' ,$this->idGrupo)->update([ 'img'  => NULL ]);
        $grupo = Grupo::where([ 'id' => $this->idGrupo ])->first();
        $this->dataModalGrupo($grupo);
    }

    public function updateImg($path)
    {
        Grupo::where( 'id' ,$this->idGrupo)->update([ 'img'  => $path ]);
        $grupo = Grupo::where([ 'id' => $this->idGrupo ])->first();
        $this->dataModalGrupo($grupo);
    }

}
