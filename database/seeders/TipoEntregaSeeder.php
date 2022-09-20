<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoEntregaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_entregas')->insert([
            'entrega'          => 'DELIVERY',
            'descripcion'   => 'INGRESAR INFORMACIÓN DESCRIPTICA A ESTE TIPO DE ENTREGA, VALORES, SECTORES, HORARIOS, ETC.',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('tipo_entregas')->insert([
            'entrega'          => 'EN LOCAL',
            'descripcion'   => 'INGRESAR INFORMACIÓN DESCRIPTICA A ESTE TIPO DE ENTREGA',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('tipo_entregas')->insert([
            'entrega'          => 'TAKE AWAY',
            'descripcion'   => 'INGRESAR INFORMACIÓN DESCRIPTICA A ESTE TIPO DE ENTREGA',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
