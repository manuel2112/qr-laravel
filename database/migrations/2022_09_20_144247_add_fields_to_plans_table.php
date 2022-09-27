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
        Schema::table('plans', function (Blueprint $table) {

            $table->after('img', function($table){

                $table->string('legend',128)->nullable();
                $table->string('qr',128)->nullable();
                $table->string('panel',128)->nullable();
                $table->string('categorias',128)->nullable();
                $table->string('productos',128)->nullable();
                $table->string('con_img',128)->nullable();
                $table->string('max_img',128)->nullable();
                $table->string('url',128)->nullable();
                $table->string('redes',128)->nullable();
                $table->string('update',128)->nullable();
                $table->string('visual',128)->nullable();
                $table->string('admin',128)->nullable();
                $table->string('tecnico',128)->nullable();

            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('legend');
            $table->dropColumn('qr');
            $table->dropColumn('panel');
            $table->dropColumn('categorias');
            $table->dropColumn('productos');
            $table->dropColumn('con_img');
            $table->dropColumn('max_img');
            $table->dropColumn('url');
            $table->dropColumn('redes');
            $table->dropColumn('update');
            $table->dropColumn('visual');
            $table->dropColumn('tecnico');
            $table->dropColumn('admin');
        });
    }
};
