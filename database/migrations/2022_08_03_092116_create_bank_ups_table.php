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
        Schema::create('bank_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rentservice_id');
            $table->foreign('rentservice_id')->on('rent_services')->references('order_id')->cascadeOnDelete();
            $table->integer('receipt_num');
            $table->float('amount_collected');
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
        Schema::dropIfExists('bank_ups');
    }
};
