<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneradorController extends Controller
{
    public function pago(Request $request){
        $compra = Compra::where(['id' => $request->id])->first();
        $pdf    = PDF::loadView('pdf.pago', [
                                    'compra' => $compra
                                ]);
        return $pdf->download('COMPRA_'.$compra->orden.'.pdf');
    }
}
