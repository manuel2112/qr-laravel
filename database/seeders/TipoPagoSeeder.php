<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_pagos')->insert([
            'pago'          => 'EFECTIVO',
            'descripcion'   => 'INGRESAR INFORMACIÓN DESCRIPTICA A ESTE TIPO DE PAGO',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('tipo_pagos')->insert([
            'pago'          => 'TARJETA (CONTRA ENTREGA)',
            'descripcion'   => 'INGRESAR INFORMACIÓN DESCRIPTICA A ESTE TIPO DE PAGO, TARJETAS ACEPTADAS, DÉBITO, CRÉDITO, ETC.',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('tipo_pagos')->insert([
            'pago'          => 'TRANSFERENCIA',
            'descripcion'   => 'INGRESAR LOS DATOS PARA REALIZAR TRANSFERENCIA BANCARIA, BANCO, CUENTA, RUT , ETC.',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
