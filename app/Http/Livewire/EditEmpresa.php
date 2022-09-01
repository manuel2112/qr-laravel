<?php

namespace App\Http\Livewire;

use App\Helpers\Slug;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Empresa;
use Livewire\Component;

class EditEmpresa extends Component
{
    public $idEmpresa;
    public $empresa;
    public $direccion;
    public $region;
    public $ciudad;
    public $telefono;
    public $whatsapp;
    public $web;
    public $facebook;
    public $instagram;
    public $descripcion;
    public $slug;

    protected $rules = [
        'empresa'       => 'required|string|max:255',
        'ciudad'        => 'required|numeric',
        'telefono'      => 'required|numeric|digits:9',
        'whatsapp'      => 'sometimes|nullable|numeric|digits:9',
        'web'           => 'sometimes|nullable|url',
        'facebook'      => 'sometimes|nullable|url',
        'instagram'     => 'sometimes|nullable|url',
    ];

    public function mount(Empresa $empresa)
    {
        $this->idEmpresa    = $empresa->id;
        $this->empresa      = $empresa->empresa;
        $this->direccion    = $empresa->direccion;
        $this->ciudad       = $empresa->ciudad_id ;
        $ciudad             = Commune::where(['id' => $this->ciudad])->first();
        $this->region       = $ciudad->region_id;
        $this->telefono     = $empresa->fono;
        $this->whatsapp     = $empresa->whatsapp;
        $this->web          = $empresa->web;
        $this->facebook     = $empresa->facebook;
        $this->instagram    = $empresa->instagram;
        $this->descripcion  = $empresa->descripcion;
    }

    public function render()
    {
        $regions    = Region::all();
        $communes   = Commune::orderBy('name', 'asc')->get();
        return view('livewire.edit-empresa', [
            'regions' => $regions,
            'communes' => $communes
        ]);
    }
    
    public function updatedRegion($region){
        $this->communes = Commune::where('region_id',$region)->orderBy('name', 'asc')->get();
        $this->ciudad = '';
    }

    public function updateSlug($empresaNombre,$id)
    {
        return Slug::instance(Empresa::class, 'slug')->createSlug($empresaNombre, $id);
    }

    public function editEmpresa(){
        $this->validate();

        Empresa::where('user_id', auth()->user()->id)
                ->update([
                    'empresa'       => $this->empresa,
                    'direccion'     => $this->direccion,
                    'ciudad_id'     => $this->ciudad,
                    'fono'          => $this->telefono,
                    'whatsapp'      => $this->whatsapp,
                    'web'           => $this->web,
                    'facebook'      => $this->facebook,
                    'instagram'     => $this->instagram,
                    'descripcion'   => $this->descripcion,
                    'slug'          => $this->updateSlug($this->empresa,$this->idEmpresa)
                ]);

        session()->flash('mensaje','Los datos de tu empresa se han editado exitosamente');
        return redirect()->route('empresa.index');
    }
}
