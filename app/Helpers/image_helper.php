<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if(!function_exists('uploadImage'))
{
	function uploadImage($img, $idEmpresa, $isLogo)
	{
        $image  = $img;
        $extImg = $image->getClientOriginalExtension();
        $nmbImg = 'logo-' . Str::uuid() . '.' .$extImg;
        $pathDB = 'uploads/empresas/'.$idEmpresa.'/logotipo/'.$nmbImg ;
        $path   = public_path($pathDB);
        $width  = 500;
        $height = 500;
        
        if( $extImg == 'png' ){
            $canvas = Image::canvas($width, $height);
        }else{
            $canvas = Image::canvas($width, $height, '#fff');
        }        

        $image = Image::make($image->getRealPath())->resize($width, $height, function($constraint)
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