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
        Schema::create('empresa_tipo_entregas', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_entrega_id')->unsigned();
            $table->foreign('tipo_entrega_id')->references('id')->on('tipo_entregas');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('detalle')->nullable();
            $table->boolean('flag')->default(0);
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
        Schema::dropIfExists('empresa_tipo_entregas');
    }
};
