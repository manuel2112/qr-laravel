<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class EditLogo extends Component
{
    public $empresa;
    public $logotipo;

    use WithFileUploads;

    protected $rules = [
        'logotipo'  => 'required|image|max:1024'
    ];

    protected $listeners = ['deleteLogotipo'];

    public function render()
    {
        return view('livewire.edit-logo');
    }

    public function editLogo(){
        $this->validate();

        $path = uploadImage($this->logotipo, $this->empresa->id, TRUE);

        //UPDATE QR
        create_qr($path, $this->empresa);

        Empresa::where( 'id' ,$this->empresa->id)
                ->update([
                    'logotipo'  => $path
                ]);

        session()->flash('mensaje','El logotipo ha sido ingresado exitosamente');
        return redirect()->route('empresa.index');
    }

    public function deleteLogotipo(Empresa $empresa){
        Empresa::where( 'id' ,$empresa->id)
                ->update([
                    'logotipo'  => NULL
                ]);

        session()->flash('mensaje','La imagen ha sido eliminada exitosamente');
        return redirect()->route('empresa.index');
    }
}
