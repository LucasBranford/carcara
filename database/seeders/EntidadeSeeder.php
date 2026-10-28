<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class EntidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateEntidade();

        DB::table('entidades')->insert([
            'name' => 'Rede de Grêmios do IFRN',
            'sigla' => 'REGIF',
            'CNPJ' => '32421546234',
            'logo' => 'public/entidades/REGIF/Logo REGIF.jpg',
            'email' => 'lucasfelipecarlos@hotmail.com',
            'instagram' => 'www.instagram.com/regif_ifrn',
            'telefone' => '(84) 3422-2660',
            'unidade_id' => 1,
            'endereco' => ' R. Dr. Nilo Bezerra Ramalho, 1692 - Tirol, Natal - RN, 59015-000, Sala 13',
            'atafundacao' => 'public/entidades/REGIF/Ata de Fundação/Ata de Fundação - REGIF.jpg',
            'estatuto' => 'public/entidades/REGIF/Estatuto - REGIF.pdf',
        ]);
    
    }
    public function truncateEntidade()
    {
        $this->command->info('Truncating Entidade');
  Schema::disableForeignKeyConstraints();

        DB::table('entidades')->truncate();






    }
}
