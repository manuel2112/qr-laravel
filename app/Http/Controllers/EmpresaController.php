<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function index()
    {
        $idUser = Auth::id();
        $empresa = Empresa::where(['user_id' => $idUser])->first();
        $comuna  = Commune::where(['id' => $empresa->ciudad_id])->first();
        
        return view('empresa.index', [
            'empresa' => $empresa,
            'comuna' => $comuna
        ]);
    }
}
