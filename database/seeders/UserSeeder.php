<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria o usuário administrador
        $user = User::firstOrCreate(
            ['matricula' => '20171024010009'], // Busca por este campo
            [
                'name' => 'Admin Teste',
                'email' => 'admin@teste.com',
                'password' => Hash::make('123456'), // Criptografa a senha
                'telefone' => '(84) 99999-9999',
                // 'unidade_id' => 1, // Descomente e coloque os IDs se for obrigatório no seu banco
                // 'entidade_id' => 1,
            ]
        );

        // Atribui a role do Laratrust (que criamos anteriormente)
        // O 'firstOrCreate' evita erro se o usuário já existir
        if (!$user->hasRole('SUPERADMINISTRATOR')) {
            $user->addRole('SUPERADMINISTRATOR');
        }

        $this->command->info('Usuário Admin criado com sucesso! Matrícula: 123456 | Senha: 123456');
    }
}
