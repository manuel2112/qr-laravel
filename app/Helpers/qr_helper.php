<?php

use App\Models\QR;
use Illuminate\Support\Str;
use LaravelQRCode\Facades\QRCode;

if (! function_exists('create_qr')) {
    function create_qr($empresa)
    {
        $idEmpresa  = $empresa->user_id;
        $url        = urlQR().$empresa->slug;
        $directorio = "../storage/public/empresas/".$idEmpresa."/qr/";
        createDir($directorio);        

        $nameFile = 'qr-'.Str::uuid().'.png';
        $pathFile = $idEmpresa."/qr/".$nameFile;

        $qrImg = public_path($directorio . $nameFile); 
        QRCode::text($url)
                ->setSize(480)
                ->setMargin(1)
                ->setOutfile($qrImg)
                ->png();

        QR::create([
            'user_id'   => $empresa->user_id,
            'qr'        => $pathFile
        ]);
    }
}