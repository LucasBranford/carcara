<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargos')->insert([
            'name' => 'Presidente da REGIF',
            'gevp'=>0,
            'gedm'=>0,
        
            'diretoria_id' => 1,
        ]);
        DB::table('cargos')->insert([
            'name' => 'Vice-presidente',
            'gevp'=>0,
            'gedm'=>0,
     
            'diretoria_id' => 1,
        ]);
        DB::table('cargos')->insert([
            'name' => 'Secretário-geral',
            'gevp'=>0,
            'gedm'=>0,
          
            'diretoria_id' => 1,
        ]);
        DB::table('cargos')->insert([
            'name' => 'Secretária-geral',
            'gevp'=>0,
            'gedm'=>0,
              'diretoria_id' => 1,
        ]);
//Cargos comuns
        DB::table('cargos')->insert([
            'name' => 'Presidente',
          

            'diretoria_id' => 1,
        ]);

    }
}
