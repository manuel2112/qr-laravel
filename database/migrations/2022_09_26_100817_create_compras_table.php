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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->integer('meses')->nullable();
            $table->integer('neto')->nullable();
            $table->integer('iva')->nullable();
            $table->integer('total')->nullable();
            $table->integer('orden')->nullable();
            $table->string('token')->nullable();
            $table->string('session_id')->nullable();
            $table->tinyInteger('status')->comment('1: pendiente. 2: aprobado')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('compras');
    }
};
