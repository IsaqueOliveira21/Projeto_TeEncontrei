<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores_telefones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('colaborador_id')->unsigned();
            $table->char('numero_telefone', 15);
            $table->timestamps();
            $table->foreign('colaborador_id')->references('id')->on('colaboradores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaboradores_telefones');
    }
};
