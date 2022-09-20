<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call( CommuneRegionSeeder::class );
        // $this->call( PlanSeeder::class );
        $this->call( TipoPagoSeeder::class );
        $this->call( TipoEntregaSeeder::class );
    }
}
