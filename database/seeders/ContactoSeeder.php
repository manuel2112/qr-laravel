<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contactos')->insert([
            'subject'       => 'CONSULTA',
            'descripcion'   => 'CONSULTAS GENERALES DE TODO TIPO, DUDAS, AYUDA, ETC.',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('contactos')->insert([
            'subject'       => 'PROBLEMAS EN EL SISTEMA',
            'descripcion'   => 'CUÉNTANOS QUE PROBLEMA ESTÁ OCURRIENDO EN LA PLATAFORMA, Y LO SOLUCIONAREMOS A LA BREVEDAD',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('contactos')->insert([
            'subject'       => 'RECLAMO',
            'descripcion'   => 'CUÉNTANOS EN QUE TE PODÉMOS AYUDAR PARA SOLUCIONAR TU PROBLEMA',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('contactos')->insert([
            'subject'       => 'MEJORAS',
            'descripcion'   => 'CUÉNTANOS QUE IDEA TIENES PARA MEJORAR TU EXPERIENCIA Y LA DE TUS USUARIOS',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('contactos')->insert([
            'subject'       => 'PROBLEMAS CON EL PAGO',
            'descripcion'   => 'SI HAS TENIDO PROBLEMAS CON TU PAGO O TU MEMBRESÍA, TE AYUDAREMOS',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('contactos')->insert([
            'subject'       => 'FELICITACIONES',
            'descripcion'   => 'SI NOS DESES FELICITAR, ESTAREMOS FELICES DE ESCUCHAR TUS COMENTARIOS',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('contactos')->insert([
            'subject'       => 'SERVICIO DE ADMINISTRACIÓN',
            'descripcion'   => 'SI TIENES CONTRATADO UN PLAN CON ESTE SERVICIOS, CUÉNTANOS QUE DESEAS ACTUALIZAR Y LO HAREMOS A LA BREVEDAD',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
