<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    
    public function index()
    {
        $idUser  = Auth::id();
        $empresa = Empresa::where(['user_id' => $idUser])->first();
        
        return view('empresa.index', [
            'empresa' => $empresa
        ]);
    }
    
    public function uploadCropImage(Request $request){
        
        // $images = $request->isNormal == 'true' ? $request->imageNormal : $request->imageCrop ;
        
        // $idUser  = Auth::id();
        // $empresa = Empresa::where(['user_id' => $idUser])->first();
 
        // list($type, $images) = explode(';', $images);
        // list(, $images)      = explode(',', $images);

        // if( $type == "data:image/png" ){
        //     $ext = '.png';
        // }else{
        //     $ext = '.jpg';
        // }
        
        // $images     = base64_decode($images);
        // $image_name = Str::uuid() . $ext;
        // $pathTh     = public_path('thumbnail/'.$image_name);
        // file_put_contents($pathTh, $images);

        // $folder = 'logotipo';
        // $path = uploadImage($pathTh, $empresa->id, TRUE, $folder);

        // //UPDATE QR
        // create_qr($path, $empresa);

        // Empresa::where( 'id' ,$empresa->id)
        //         ->update([
        //             'logotipo'  => $path
        //         ]);

        // session()->flash('mensaje','El logotipo ha sido ingresado exitosamente');
        // return response()->json(['url'=> route('empresa.index') ]);
    }
}
