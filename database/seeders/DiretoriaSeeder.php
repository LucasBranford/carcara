<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiretoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateDiretoria();

        DB::table('diretorias')->insert([
            'name_diretoria' => 'Executiva',
            'sigla' => 'DIEXE',
            'atribuicoes' => '
            ulla sit amet rhoncus tellus. Nam semper nisi non lorem faucibus, vitae porta nulla mollis. Donec vel ipsum vel eros tincidunt auctor vitae non nunc. Nulla ullamcorper massa ac enim euismod rhoncus. In hac habitasse platea dictumst. Donec tempor arcu quis iaculis tempus. Pellentesque pharetra justo ac sodales aliquam. Aenean justo dui, molestie at ligula et, mollis vehicula ex. Sed efficitur lorem nec vehicula rutrum. Sed in eros eleifend, rutrum diam vitae, gravida tellus. Vivamus nec libero eu nisl fringilla tempus et tincidunt leo. Nunc id mattis orci. Morbi feugiat tincidunt elit, ut mollis erat aliquam et. In pharetra elementum enim, vitae accumsan justo maximus semper. Donec id risus tempor, sollicitudin urna ac, condimentum lectus.',


        ]);

    }
    public function truncateDiretoria()
    {
        $this->command->info('Truncating Diretoria');
  Schema::disableForeignKeyConstraints();

        DB::table('diretorias')->truncate();






    }
}
