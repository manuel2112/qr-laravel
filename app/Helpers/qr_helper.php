<?php

use App\Models\QR;
use Illuminate\Support\Str;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

if (! function_exists('create_qr')) {
    function create_qr($pathImg, $empresa)
    {
        //https://github.com/endroid/qr-code

        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create(urlQR().$empresa->slug)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(496)
            ->setMargin(2)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin(false))
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        
        // Create generic logo
        if( $pathImg ){
            $logo = Logo::create($pathImg)->setResizeToWidth(100);
            $result = $writer->write($qrCode, $logo);
        }else{
            $result = $writer->write($qrCode);
        }

        header('Content-Type: '.$result->getMimeType());

        // Save it to a file
        $nmbImg = 'qr-' . Str::uuid() . '.png';
        $path = 'uploads/empresas/'.$empresa->id.'/qr/'.$nmbImg;
        $result->saveToFile(public_path($path));

        QR::where( 'user_id' ,$empresa->user_id)
                ->update([
                    'flag'  => FALSE
                ]);

        QR::create([
            'user_id'   => $empresa->user_id,
            'qr'        => $path
        ]);
    }
}