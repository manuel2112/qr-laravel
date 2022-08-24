<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Region;
use App\Models\Commune;
use Livewire\Component;
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
    // public $direccion;
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
        'telefono'      => 'required|string',
        'email'         => 'required|string|email|max:255|unique:users',
        'password'      => 'required|confirmed|min:8',
        'cuentanos'     => 'required',
        'referido'      => 'required_if:cuentanos,==,REFERIDO',
    ];

    public function crearRegistro(){
        $this->validate();

        $user = User::create([
            'name' => $this->empresa,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

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
