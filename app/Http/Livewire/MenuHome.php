<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class MenuHome extends Component
{
    public $grupos;

    protected $listeners = ['reRenderParent', 'showMessage', 'grupoShow', 'grupoDelete', 'instanciar', 'closeModals', 'productoDelete', 'productoShow', 'productoLink'];

    public function render()
    {
        return view('livewire.menu-home');
    }

    public function mount(){
        $idUser = Auth::id();
        $this->grupos = Grupo::where(['user_id' => $idUser, 'flag' => TRUE])->orderBy('order', 'asc')->get();
    }

    public function grupoShow($idGrupo, $flag){
        Grupo::where('id', $idGrupo)->update([ 'show' => !$flag ]);
        $this->reRenderParent();
    }

    public function grupoDelete($idGrupo){
        Grupo::where('id', $idGrupo)->update([ 'flag' => FALSE ]);
        $this->reRenderParent();
    }

    public function productoShow($idProducto, $flag){
        Producto::where('id', $idProducto)->update([ 'show' => !$flag ]);
        $this->reRenderParent();
    }

    public function productoLink($idProducto, $flag){
        Producto::where('id', $idProducto)->update([ 'link' => !$flag ]);
        $this->reRenderParent();
    }

    public function productoDelete($idProducto){
        Producto::where('id', $idProducto)->update([ 'flag' => FALSE ]);
        $this->reRenderParent();
    }

    public function reRenderParent()
    {
        $this->mount();
    }
    
    public function showMessage($texto)
    {
        session()->flash('mensaje',$texto);
    }

    public function openMdlGrupoImg(Grupo $grupo)
    {
        $this->emit('dataModalGrupo',$grupo);
        $this->dispatchBrowserEvent('openMdlGrupoImg');
    }

    public function openMdlGrupoEdit(Grupo $grupo)
    {
        $this->emit('dataModalGrupoEdit',$grupo);
        $this->dispatchBrowserEvent('openMdlGrupoEdit');
    }

    public function openMdlProductoAdd(Grupo $grupo)
    {
        $this->emit('dataModalProductoAdd',$grupo);
        $this->dispatchBrowserEvent('openMdlProductoAdd');
    }

    public function closeModals()
    {      
        $this->dispatchBrowserEvent('closeModal');
    }


    
}
