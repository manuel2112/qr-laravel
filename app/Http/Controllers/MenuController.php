<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{    
    public function __invoke()
    {        
        return view('menu.index');
    }
    
    public function uploadGrupoImg(Request $request){
        
        $images = $request->isNormal == 'true' ? $request->imageNormal : $request->imageCrop ;
        
        $idUser  = Auth::id();
        $empresa = Empresa::where(['user_id' => $idUser])->first();
 
        list($type, $images) = explode(';', $images);
        list(, $images)      = explode(',', $images);

        if( $type == "data:image/png" ){
            $ext = '.png';
        }else{
            $ext = '.jpg';
        }
        
        $images     = base64_decode($images);
        $image_name = Str::uuid() . $ext;
        $pathTh     = public_path('thumbnail/'.$image_name);
        file_put_contents($pathTh, $images);

        $path = uploadImage($pathTh, $empresa->id, TRUE);
        return response()->json(['path'=> $path ]);
    }
}
