<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDiretorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('diretorias', function (Blueprint $table) {
            $table->id();
            $table->string('name_diretoria')->unique();
            $table->string('sigla')->unique();
            $table->text('atribuicoes');
            $table->boolean('regif')->default(true);
            $table->boolean('gedm')->default(true);
            $table->boolean('gevp')->default(true);






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
        Schema::dropIfExists('diretorias');
    }
}
