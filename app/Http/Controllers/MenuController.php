<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductoImagen;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{    
    public function __invoke()
    {        
        return view('menu.index');
    }
    
    public function uploadgrupoimg(Request $request)
    {
        $isNormal = $request->isNormal == 'true' ? TRUE : FALSE ;

        if( $isNormal ){
            $images = $request->imageNormal;
            $hSize  = 500;
        }else{
            $images = $request->imageCrop ;
            $hSize  = 278;
        }
        
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

        $folder = 'grupo';
        $path = uploadImage($pathTh, $empresa->id, FALSE, $folder, NULL, $isNormal);
        return response()->json(['path'=> $path ]);
    }

    public function uploadproductoimg(Request $request)
    {        
        $isNormal = $request->isNormal == 'true' ? TRUE : FALSE ;

        $images = $isNormal ? $request->imageNormal : $request->imageCrop;
 
        list($type, $images) = explode(';', $images);
        list(, $images)      = explode(',', $images);

        $ext = $type == "data:image/png" ? '.png' : '.jpg' ;
        
        $images     = base64_decode($images);
        $image_name = Str::uuid() . $ext;
        $path       = 'thumbnail/'.$image_name;
        $pathTh     = public_path($path);
        file_put_contents($pathTh, $images);

        return response()->json(['path'=> $path ]);
    }

    public function uploadgaleriaimg(Request $request)
    {
        $isNormal = $request->isNormal == 'true' ? TRUE : FALSE ;

        $images = $isNormal ? $request->imageNormal : $request->imageCrop;
        $idProducto = $request->idProducto;
 
        list($type, $images) = explode(';', $images);
        list(, $images)      = explode(',', $images);

        $ext = $type == "data:image/png" ? '.png' : '.jpg' ;
        
        $images     = base64_decode($images);
        $image_name = Str::uuid() . $ext;
        $path       = 'thumbnail/'.$image_name;
        $pathTh     = public_path($path);
        file_put_contents($pathTh, $images);

        $idUser  = Auth::id();
        $empresa = Empresa::where(['user_id' => $idUser])->first();

        $folder = 'producto';
        $path = uploadImage($pathTh, $empresa->id, FALSE, $folder, $idProducto, TRUE);

        ProductoImagen::create([
            'producto_id'   => $idProducto,
            'img'           => $path
        ]);

        return response()->json(['path'=> $path ]);
    }
}
