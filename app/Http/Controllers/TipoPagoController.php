<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    public function __invoke()
    {        
        return view('tipopago.index');
    }
}
