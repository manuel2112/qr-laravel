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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('empresa',64);
            $table->string('direccion',128);
            $table->string('fono',32);
            $table->string('whatsapp',32)->nullable();
            $table->string('logotipo',128)->nullable();
            $table->string('web',128)->nullable();
            $table->string('facebook',128)->nullable();
            $table->string('instagram',128)->nullable();
            $table->string('slug',128)->unique();
            $table->text('descripcion')->nullable();
            $table->integer('ciudad_id')->unsigned();
            $table->foreign('ciudad_id')->references('id')->on('communs');
            $table->string('referido',64);
            $table->boolean('is_admin')->default(0);
            $table->boolean('vista')->default(0);
            $table->boolean('pago')->default(0);
            $table->boolean('membresia')->default(1);
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
        Schema::dropIfExists('empresas');
    }
};
