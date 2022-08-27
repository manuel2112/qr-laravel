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
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATA',
            'valor'         => 10000,
            'vistas'        => 1000,
            'img'           => 3,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATA PREMIUM',
            'valor'         => 15000,
            'vistas'        => 1000,
            'img'           => 3,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'ORO',
            'valor'         => 20000,
            'vistas'        => 5000,
            'img'           => 9,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'ORO PREMIUM',
            'valor'         => 25000,
            'vistas'        => 5000,
            'img'           => 9,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATINO',
            'valor'         => 40000,
            'vistas'        => null,
            'img'           => 20,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        DB::table('plans')->insert([
            'plan'          => 'PLATINO PREMIUM',
            'valor'         => 45000,
            'vistas'        => null,
            'img'           => 20,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
