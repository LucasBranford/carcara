<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('matricula')->default(0)->autoIncrement();
            $table->string('telefone')->nullable();
            $table->string('turma')->nullable(); //depois criar essa tabela e usar chave est
            $table->string('curso')->nullable(); //depois criar essa tabela e usar chave est

            //Unidade de ensino vinculada
            $table->unsignedBigInteger('unidade_id')->nullable();
            $table->foreign('unidade_id')->references('id')->on('unidades');

            //Gestão
            $table->unsignedBigInteger('gestao_id')->nullable();

            $table->foreign('gestao_id')->references('id')->on('gestoes');

            $table->integer('team_id')->unsigned()->nullable()->default(null);
            $table->foreign('team_id')->references('id')->on('teams');

            $table->unsignedBigInteger('entidade_id')->nullable()->default(null);;

            $table->foreign('entidade_id')->references('id')->on('entidades')->nullable()->default(null);




            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
