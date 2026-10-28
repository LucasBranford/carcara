<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
       
        DB::table('unidades')->insert([
            'name' => 'Câmpus Natal - Central',
            'sigla' => "CNAT",
            'cidade' => "Natal",
            'endereco' => "Av. Sen. Salgado Filho, 1559 - Tirol, Natal - RN, 59015-000"


        ]);
        //2
        DB::table('unidades')->insert([
            'name' => 'Câmpus Mossoró',
            'sigla' => "MO",
            'cidade' => "Mossoró",
            'endereco' => "R. Raimundo Firmino de Oliveira, 400 - Conjunto Ulrick Graff, Mossoró - RN, 59628-330"

            //3
        ]);
        DB::table('unidades')->insert([
            'name' => 'Câmpus Currais Novos',
            'sigla' => "CN",
            'cidade' => "Currais Novos",
            'endereco' => "Rua Manoel Lopes Filho, 773, Currais Novos - RN, 59380-000"


        ]);
        //4
        DB::table('unidades')->insert([
            'name' => 'Câmpus Natal - Zona Norte',
            'sigla' => "ZN",
            'cidade' => "Natal",
            'endereco' => "R. Brusque, 2926 - Potengi, Natal - RN, 59112-490"


        ]);
        //5
        DB::table('unidades')->insert([
            'name' => 'Câmpus Ipanguaçu',
            'sigla' => "IP",
            'cidade' => "Ipanguaçu",
            'endereco' => "RN-118, s/n - Zona Rural, Ipanguaçu - RN, 59508-000"


        ]);
        //6
        DB::table('unidades')->insert([
            'name' => 'Câmpus João Câmara',
            'sigla' => "JC",
            'cidade' => "João Câmara",
            'endereco' => "BR-406 KM 73 3500 Perímetro Rural, João Câmara - RN, 59550-000"


        ]);
        //7

        DB::table('unidades')->insert([
            'name' => 'Câmpus Macau',
            'sigla' => "MC",
            'cidade' => "Macau",
            'endereco' => "RN-221, Macau - RN, 59500-000"


        ]);
        //8
        DB::table('unidades')->insert([
            'name' => 'Câmpus Apodi',
            'sigla' => "AP",
            'cidade' => "Apodi",
            'endereco' => "Apodi - RN, 59700-000"


        ]);
        //9
        DB::table('unidades')->insert([
            'name' => 'Câmpus Pau dos Ferros',
            'sigla' => "PF",
            'cidade' => "Pau dos Ferros",
            'endereco' => "BR-405 S/N, Pau dos Ferros - RN, 59900-000"


        ]);
        //10
        DB::table('unidades')->insert([
            'name' => 'Câmpus Caicó',
            'sigla' => "CA",
            'cidade' => "Caicó",
            'endereco' => "RN-288, s/n - Nova, Caicó - RN, 59300-000"


        ]);
        //11
        DB::table('unidades')->insert([
            'name' => 'Câmpus Santa Cruz',
            'sigla' => "SC",
            'cidade' => "Santa Cruz",
            'endereco' => "Rua Cleto Antunes, Pte. do Paraíso, 304, Santa Cruz - RN, 59200-000"


        ]);
        //12
        DB::table('unidades')->insert([
            'name' => 'Câmpus Natal - Cidade Alta',
            'sigla' => "CAL",
            'cidade' => "Natal",
            'endereco' => "Av. Rio Branco, 743 - Cidade Alta, Natal - RN, 59025-003"


        ]);
        //13
        DB::table('unidades')->insert([
            'name' => 'Câmpus Nova Cruz',
            'sigla' => "NC",
            'cidade' => "Macau",
            'endereco' => "Av. José Rodrigues de Aquino Filho, 640 - Alto de Santa Luzia, Nova Cruz - RN, 59215-000"


        ]);

        //14
        DB::table('unidades')->insert([
            'name' => 'Câmpus Parnamirim',
            'sigla' => "PAR",
            'cidade' => "Parnamirim",
            'endereco' => "R. Antônia de Lima Paiva, 155 - Nova Esperança, Parnamirim - RN, 59143-455"


        ]);
        //15
        DB::table('unidades')->insert([
            'name' => 'Câmpus Natal - Zona Leste',
            'sigla' => "ZL",
            'cidade' => "Natal",
            'endereco' => "Av. Sen. Salgado Filho, 1559 - Tirol, Natal - RN, 59015-000"


        ]);
        //16
        DB::table('unidades')->insert([
            'name' => 'Câmpus São Gonçalo do Amarante',
            'sigla' => "SGA",
            'cidade' => "São Gonçalo do Amarante",
            'endereco' => "Estrada Guanduba, s/n, São Gonçalo do Amarante - RN, 59291-727"


        ]);
        //17
        DB::table('unidades')->insert([
            'name' => 'Câmpus Ceará-mirim',
            'sigla' => "CM",
            'cidade' => "Ceará-mirim",
            'endereco' => "406 Avenida Planalto, RN, 59580-000"


        ]);
        //18
        DB::table('unidades')->insert([
            'name' => 'Câmpus São Paulo do Potengi',
            'sigla' => "SPP",
            'cidade' => "São Paulo do Potengi",
            'endereco' => "Av. Potengi, São Paulo do Potengi - RN, 59460-000"


        ]);
        //19
        DB::table('unidades')->insert([
            'name' => 'Câmpus Canguaretama',
            'sigla' => "CANG",
            'cidade' => "Canguaretama",
            'endereco' => "160 BR-101, S/N - Areia Branca, Canguaretama - RN, 59190-000"


        ]);
        //20
        DB::table('unidades')->insert([
            'name' => 'Câmpus Lajes',
            'sigla' => "LAJ",
            'cidade' => "Lajes",
            'endereco' => "BR-304, Km 120, s/n - Centro, Lajes - RN, 59535-000"


        ]);
        //21
        DB::table('unidades')->insert([
            'name' => 'Câmpus Parelhas',
            'sigla' => "PAAS",
            'cidade' => "Parelhas",
            'endereco' => "R. Dr. Mauro Duarte - José Clóvis, Parelhas - RN, 59360-000"


        ]);
        DB::table('unidades')->insert([
            'name' => 'Reitoria',
            'sigla' => "RE",
            'cidade' => "Natal",
            'endereco' => "R. Dr. Nilo Bezerra Ramalho, 1692 - Tirol, Natal - RN, 59015-300"


            
        ]);
        DB::table('unidades')->where('name','Reitoria')->update(['id' =>0]);

        DB::table('unidades')->insert([
            'name' => 'Câmpus Jucurutu',
            'sigla' => "JUC",
            'cidade' => "Jucurutu",
            'endereco' => "R. Manoel Januncio, Jucurutu - RN, 59330-000"


        ]);
        DB::table('unidades')->where('name','Câmpus Jucurutu')->update(['id' =>22]);
          
        
    }
}
