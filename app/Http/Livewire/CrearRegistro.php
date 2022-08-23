<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CrearRegistro extends Component
{
    public $empresa;
    public $responsable;
    public $telefono;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'empresa' => ['required', 'string', 'max:255'],
        'responsable' => ['required', 'string', 'max:255'],
        'telefono' => ['required', 'string'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8'],
    ];

    public function crearRegistro(){
        $this->validate();
    }

    public function render()
    {
        return view('livewire.crear-registro');
    }
}
