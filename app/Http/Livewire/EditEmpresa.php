<?php

namespace App\Http\Livewire;

use App\Helpers\Slug;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Empresa;
use Livewire\Component;
use Illuminate\Support\Facades\Request;

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

    //https://gist.github.com/shibbirweb/84f0ab7c9f74fe02e8347531557b645b
    // public function store(Request $request)
    // {
    // //Create slug
    // $post->slug = Slug::instance(Post::class, 'slug')->createSlug($request->title); // circular slug
    // }

    public function update($empresa,$id)
    {
        return Slug::instance(Empresa::class, 'slug')->createSlug($empresa, $id);
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
                    'slug'          => $this->update($this->empresa,$this->idEmpresa)
                ]);

        return redirect()->route('empresa.index');
    }
}
