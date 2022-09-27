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
        Schema::create('compras_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('compra_id')->unsigned();
            $table->foreign('compra_id')->references('id')->on('compras');
            $table->string('accounting_date')->nullable();
            $table->string('card_number',19)->nullable();
            $table->integer('amount')->nullable();
            $table->string('authorization_code',6)->nullable();
            $table->string('payment_type_code',2)->nullable();
            $table->integer('response_code')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('vci')->nullable();
            $table->string('status',64)->nullable();
            $table->string('installments_amount',17)->nullable();
            $table->string('installments_number',2)->nullable();
            $table->string('balance',17)->nullable();
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
        Schema::dropIfExists('compras_requests');
    }
};
