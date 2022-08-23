<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CrearLogin extends Component
{
    public $email;
    public $password;
    public $remember;

    public function render()
    {
        return view('livewire.crear-login');
    }
}
