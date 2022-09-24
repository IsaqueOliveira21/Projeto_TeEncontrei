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
        Schema::create('visitas_detalhes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('visita_cabecalho_id')->unsigned();
            $table->bigInteger('colaborador_id')->unsigned();
            $table->enum('tipo', ['CHECK-IN', 'CHECK-OUT'])->default('CHECK-IN');
            $table->timestamps();
            $table->foreign('visita_cabecalho_id')->references('id')->on('visitas_cabecalhos')->onDelete('cascade');
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
        Schema::dropIfExists('visitas_detalhes');
    }
};
