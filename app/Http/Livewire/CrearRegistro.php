<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Helpers\Slug;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Empresa;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class CrearRegistro extends Component
{
    public $empresa;
    public $responsable;
    public $direccion;
    public $region;
    public $ciudad;
    public $telefono;
    public $email;
    public $password;
    public $password_confirmation;
    public $cuentanos;
    public $referido;
    public $slug;
    public $ciudades = null;
    public $isReferido = false;

    protected $rules = [
        'empresa'       => 'required|string|max:255',
        'responsable'   => 'required|string|max:255',
        'region'        => 'required|numeric',
        'ciudad'        => 'required|numeric',
        'telefono'      => 'required|numeric|digits:9',
        'email'         => 'required|string|email|max:255|unique:users',
        'password'      => 'required|confirmed|min:8',
        'cuentanos'     => 'required',
        'referido'      => 'required_if:cuentanos,==,REFERIDO',
    ];

    public function crearRegistro(){
        $this->validate();

        $user = User::create([
            'name'      => Str::upper($this->responsable),
            'email'     => $this->email,
            'password'  => Hash::make($this->password),
        ]);

        //INSTANCIAR DATOS
        $this->slug = $this->createSlug($this->empresa);
        $referido = $this->referido ? $this->referido : $this->cuentanos;

        //INGRESAR DATA EMPRESA
        $empresaData = Empresa::create([
            'user_id'       => $user->id,
            'direccion'     => Str::upper($this->direccion),
            'fono'          => $this->telefono,
            'empresa'       => $this->empresa,
            'ciudad_id'     => $this->ciudad,
            'referido'      => Str::upper($referido),
            'slug'          => $this->slug
        ]);

        //CREATE QR
        create_qr('', $empresaData);

        //INSTANCIAR MENÚ
        menuInstanciarEmpresa($empresaData);

        //REGALAR PLAN PLATA
        instanciarPlan($empresaData,2);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        $regions = Region::all();
        return view('livewire.crear-registro', [
            'regions' => $regions
        ]);
    }

    public function updatedRegion($region){
        $this->ciudades = Commune::where('region_id',$region)->orderBy('name', 'asc')->get();
    }

    public function updatedCuentanos($referido){
        if( $referido == 'REFERIDO' ){
            $this->isReferido = true;
        }else{
            $this->isReferido = false;
        }
    }

    public function createSlug($empresaNombre)
    {
        return Slug::instance(Empresa::class, 'slug')->createSlug($empresaNombre);
    }
}
