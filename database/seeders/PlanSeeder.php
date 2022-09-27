<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'plan'          => 'BRONCE',
            'valor'         => null,
            'vistas'        => 200,
            'img'           => 1,
            'legend'        => 'Desarrollando mi PYME',
            'qr'            => 'Código QR',
            'panel'         => NULL,
            'categorias'    => NULL,
            'productos'     => NULL,
            'con_img'       => NULL,
            'max_img'       => NULL,
            'url'           => 'URL Personalizada',
            'redes'         => NULL,
            'update'        => NULL,
            'visual'        => 'visualizaciones máximo del menú por mes',
            'tecnico'       => 'Servicio Técnico',
            'admin'         => NULL,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATA',
            'valor'         => 10000,
            'vistas'        => 1000,
            'img'           => 3,
            'legend'        => 'La Mejor Opción',
            'qr'            => 'Código QR personalizado con tu logo',
            'panel'         => 'Panel autoadministrable',
            'categorias'    => 'Categorías ilimitadas',
            'productos'     => 'Productos ilimitados',
            'con_img'       => 'Productos con imágenes',
            'max_img'       => 'imágenes máximo por producto',
            'url'           => 'URL Personalizada',
            'redes'         => 'Botónes a tus Redes Sociales y Whatsapp',
            'update'        => 'Actualizacions ilimitadas',
            'admin'         => NULL,
            'visual'        => 'visualizaciones máximo del menú por mes',
            'tecnico'       => 'Servicio Técnico',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATA PREMIUM',
            'valor'         => 15000,
            'vistas'        => 1000,
            'img'           => 3,
            'legend'        => 'La Mejor Opción Premium',
            'qr'            => 'Código QR personalizado con tu logo',
            'panel'         => 'Panel autoadministrable',
            'categorias'    => 'Categorías ilimitadas',
            'productos'     => 'Productos ilimitados',
            'con_img'       => 'Productos con imágenes',
            'max_img'       => 'imágenes máximo por producto',
            'url'           => 'URL Personalizada',
            'redes'         => 'Botónes a tus Redes Sociales y Whatsapp',
            'update'        => 'Actualizacions ilimitadas',
            'visual'        => 'visualizaciones máximo del menú por mes',
            'admin'         => '*Servicio de administración',
            'tecnico'       => 'Servicio Técnico',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'ORO',
            'valor'         => 20000,
            'vistas'        => 5000,
            'img'           => 9,
            'legend'        => 'Medianas Empresas',
            'qr'            => 'Código QR personalizado con tu logo',
            'panel'         => 'Panel autoadministrable',
            'categorias'    => 'Categorías ilimitadas',
            'productos'     => 'Productos ilimitados',
            'con_img'       => 'Productos con imágenes',
            'max_img'       => 'imágenes máximo por producto',
            'url'           => 'URL Personalizada',
            'redes'         => 'Botónes a tus Redes Sociales y Whatsapp',
            'update'        => 'Actualizacions ilimitadas',
            'visual'        => 'visualizaciones máximo del menú por mes',
            'admin'         => NULL,
            'tecnico'       => 'Servicio Técnico',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'ORO PREMIUM',
            'valor'         => 25000,
            'vistas'        => 5000,
            'img'           => 9,
            'legend'        => 'Medianas Empresas Premium',
            'qr'            => 'Código QR personalizado con tu logo',
            'panel'         => 'Panel autoadministrable',
            'categorias'    => 'Categorías ilimitadas',
            'productos'     => 'Productos ilimitados',
            'con_img'       => 'Productos con imágenes',
            'max_img'       => 'imágenes máximo por producto',
            'url'           => 'URL Personalizada',
            'redes'         => 'Botónes a tus Redes Sociales y Whatsapp',
            'update'        => 'Actualizacions ilimitadas',
            'visual'        => 'visualizaciones máximo del menú por mes',
            'admin'         => '*Servicio de administración',
            'tecnico'       => 'Servicio Técnico',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATINO',
            'valor'         => 40000,
            'vistas'        => null,
            'img'           => 20,
            'legend'        => 'Grandes Empresas',
            'qr'            => 'Código QR personalizado con tu logo',
            'panel'         => 'Panel autoadministrable',
            'categorias'    => 'Categorías ilimitadas',
            'productos'     => 'Productos ilimitados',
            'con_img'       => 'Productos con imágenes',
            'max_img'       => 'imágenes máximo por producto',
            'url'           => 'URL Personalizada',
            'redes'         => 'Botónes a tus Redes Sociales y Whatsapp',
            'update'        => 'Actualizacions ilimitadas',
            'visual'        => 'visualizaciones máximo del menú por mes',
            'admin'         => NULL,
            'tecnico'       => 'Servicio Técnico',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATINO PREMIUM',
            'valor'         => 45000,
            'vistas'        => null,
            'img'           => 20,
            'legend'        => 'Grandes Empresas Premium',
            'qr'            => 'Código QR personalizado con tu logo',
            'panel'         => 'Panel autoadministrable',
            'categorias'    => 'Categorías ilimitadas',
            'productos'     => 'Productos ilimitados',
            'con_img'       => 'Productos con imágenes',
            'max_img'       => 'imágenes máximo por producto',
            'url'           => 'URL Personalizada',
            'redes'         => 'Botónes a tus Redes Sociales y Whatsapp',
            'update'        => 'Actualizacions ilimitadas',
            'visual'        => 'visualizaciones máximo del menú por mes',
            'admin'         => '*Servicio de administración',
            'tecnico'       => 'Servicio Técnico',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
