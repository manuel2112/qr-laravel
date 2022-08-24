<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Empresa;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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

        //INGRESAR DATA EMPRESA
        $referido = $this->referido ? $this->referido : $this->cuentanos;
        Empresa::create([
            'user_id'       => $user->id,
            'direccion'     => Str::upper($this->direccion),
            'fono'          => $this->telefono,
            'empresa'       => $this->empresa,
            'ciudad_id'     => $this->ciudad,
            'referido'      => Str::upper($referido),
            'slug'          => $this->empresa
        ]);

        // //CREATE QR
        // create_qr($idEmpresa);

        // //INSTANCIAR MENÚ
        // $this->instanciarMenu($idEmpresa);

        // //REGALAR PLAN PLATA
        // instanciarPlan($idEmpresa,$ingreso,2);

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
        $this->ciudades = Commune::where('region_id',$region)->get();
    }

    public function updatedCuentanos($referido){
        if( $referido == 'REFERIDO' ){
            $this->isReferido = true;
        }else{
            $this->isReferido = false;
        }
    }
}
