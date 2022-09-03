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

    use WithFileUploads;

    protected $listeners = ['deleteLogotipo'];

    public function render()
    {
        return view('livewire.edit-logo');
    }

    public function deleteLogotipo(Empresa $empresa){

        //UPDATE QR
        create_qr( null, $this->empresa);

        Empresa::where( 'id' ,$empresa->id)
                ->update([
                    'logotipo'  => NULL
                ]);

        session()->flash('mensaje','La imagen ha sido eliminada exitosamente');
        return redirect()->route('empresa.index');
    }
}
