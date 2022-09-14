<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;

class MenuGrupoEdit extends Component
{
    public $nombre;
    public $title;
    public $idGrupo;

    protected $rules = [
        'nombre' => 'required|string|max:64'
    ];

    protected $listeners = ['dataModalGrupoEdit'];

    public function render()
    {
        return view('livewire.menu-grupo-edit');
    }

    public function editGrupo(){
        $this->validate();

        Grupo::where('id', $this->idGrupo)->update([ 'grupo' => $this->nombre ]);

        $texto = 'Grupo actualizado exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    public function dataModalGrupoEdit(Grupo $grupo)
    {
        $this->idGrupo  = $grupo->id;
        $this->nombre   = $grupo->grupo;
        $this->title    = $grupo->grupo;
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->emit('closeModals');
    }
}
