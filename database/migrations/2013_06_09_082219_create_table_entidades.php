<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEntidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('sigla')->unique();
            $table->string('cnpj')->nullable()->default(NULL);

            $table->string('email')->unique();

            $table->string('instagram')->unique();
            $table->string('telefone')->unique()->nullable();

            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades')->nullable()->default(null);
            $table->string('logo')->nullable();
            $table->string('endereco')->unique();
            $table->string('atafundacao')->nullable();
            $table->string('estatuto');
            $table->date('datafundacao')->nullable();
            $table->date('dataofc')->nullable();



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
        Schema::dropIfExists('entidades');
    }
}
