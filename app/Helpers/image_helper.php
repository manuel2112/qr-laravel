<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if(!function_exists('uploadImage'))
{
	function uploadImage($img, $idEmpresa, $isLogo, $folder, $id, $isNormal)
	{
        $image  = $img;
        $extImg = pathinfo($image, PATHINFO_EXTENSION);
        $nmbImg = $folder . '-' . Str::uuid() . '.' .$extImg;
        $directorio = $id ? 'uploads/empresas/'.$idEmpresa.'/' . $folder . '/' . $id : 'uploads/empresas/'.$idEmpresa.'/' . $folder;
        createDir($directorio);
        $pathDB = $directorio .'/'.$nmbImg ;
        $path   = public_path($pathDB);
        $width  = 500;
        $height = $isNormal ? 500 : (500 * 5) / 9 ;
        
        if( $extImg == 'png' ){
            $canvas = Image::canvas($width, $height);
        }else{
            $canvas = Image::canvas($width, $height, '#fff');
        }

        $image = Image::make($image)->resize($width, $height, function($constraint)
        {
            $constraint->aspectRatio();
        });

        if( $isLogo ){
            $image->save($path);
        }else{
            $canvas->insert($image, 'center');
            $canvas->save($path);
        }

        return $pathDB;
	}
}