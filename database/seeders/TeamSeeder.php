<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('teams')->insert([
            'name' => 'usuarios',
            'display_name' => 'Usuários',
            'description' => "Equipe genérica de usuários"
        ]);
        DB::table('teams')->insert([
            'name' => 'admins',
            'display_name' => 'Administradores',
            'description' => "Grupo dos Administradores e Superadministradores"
        ]);
        DB::table('teams')->insert([
            'name' => 'diexe',
            'display_name' => 'Diretoria Executiva',
            'description' => "Diretoria Executiva Genérica"
        ]);
        DB::table('teams')->insert([
            'name' => 'diae',
            'display_name' => 'Diretoria de Assistência Estudantil',
            'description' => "Diretoria Assistência Estudantil Genérica"
        ]);
    }
}
