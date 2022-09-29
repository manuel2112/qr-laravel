<?php

namespace App\Http\Livewire;

use Throwable;
use Livewire\Component;
use App\Models\Contacto;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

class ContactoHome extends Component
{
    public $contacto;
    public $asunto;
    public $subject;
    public $descripcion; 
    public $mensaje;
    public $success;
    public $show;

    // protected $rules = [
    //     'asunto'    => 'required|numeric',
    //     'mensaje'   => 'required'
    // ];

    public function render()
    {
        return view('livewire.contacto-home');
    }

    public function mount(){
        $this->contacto = Contacto::orderBy('id', 'asc')->get();
    }

    public function updatedAsunto($id){
        if( $id ){
            $res = Contacto::where('id',$id)->first();
            $this->subject      = $res->subject;
            $this->descripcion  = $res->descripcion;
        }else{
            $this->subject      = '';
            $this->descripcion  = '';
        }
    }

    public function sendForm(){
        $this->validate([
            'asunto'    => 'required|numeric',
            'mensaje'   => 'required'
        ]);

        try{
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactoMailable($this->subject, $this->mensaje));
            $this->success = TRUE;
            $this->reset(['asunto','subject','descripcion','mensaje']);
        }catch (Throwable $e) {
            $this->success = FALSE;
        }
        $this->show = TRUE;
    }
}
