<?php

namespace App\Http\Controllers;

use App\Models\QR;
use App\Models\Empresa;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $idUser = auth()->user()->id;
        
        $empresa = Empresa::where(['user_id' => $idUser])->first();
        downPlan($empresa);
        
        $qr = QR::where(['user_id' => $idUser, 'flag' => TRUE])->first();
        $aviso = avisoPlan($idUser);
        
        return view('home.index', [
            'qr' => $qr,
            'empresa' => $empresa,
            'aviso' => $aviso
        ]);
    }
}
