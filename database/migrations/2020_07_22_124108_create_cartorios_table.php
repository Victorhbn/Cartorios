<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartorios', function (Blueprint $table) {
            $table->id();
            $table->string('nome',1200);
            $table->string('razao',1200);
            $table->string('documento',140);
            $table->string('cep',8);
            $table->string('endereco',1200);
            $table->string('bairro',1200);
            $table->string('cidade',1200);
            $table->string('uf',1200);
            $table->string('telefone',200)->nullable();
            $table->string('email',1200)->nullable();;
            $table->string('tabeliao',1200);
            $table->string('ativo',1200);
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
        Schema::dropIfExists('cartorios');
    }
}
