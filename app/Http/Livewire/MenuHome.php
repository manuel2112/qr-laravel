<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MenuHome extends Component
{
    public $grupos;

    protected $listeners = ['reRenderParent', 'showMessage'];

    public function render()
    {
        return view('livewire.menu-home');
    }

    public function mount(){
        $idUser = Auth::id();
        $this->grupos = Grupo::where(['user_id' => $idUser])->orderBy('order', 'asc')->get();
    }

    public function reRenderParent()
    {
        $this->mount();
    }
    
    public function showMessage($texto)
    {
        session()->flash('mensaje',$texto);
    }
}
