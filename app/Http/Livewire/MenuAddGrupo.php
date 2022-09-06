<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MenuAddGrupo extends Component
{
    public $grupo;

    protected $rules = [
        'grupo' => 'required|string|max:64'
    ];

    public function render()
    {
        return view('livewire.menu-add-grupo');
    }

    public function insertGrupo(){
        $this->validate();

        Grupo::create([
            'user_id'   => Auth::id(),
            'grupo'     => $this->grupo,
            'img'       => NULL
        ]);

        $texto = 'Grupo agregado exitosamente';
        $this->updateParent($texto);
        $this->close();
    }

    function updateParent($texto) {
        $this->emit('reRenderParent');
        $this->emit('showMessage', $texto);
    }

    public function close()
    {
        $this->reset(['grupo']);
        $this->dispatchBrowserEvent('closeModal');
    }
}
