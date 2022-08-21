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
        Schema::create('rent_services', function (Blueprint $table) {
            $table->id('order_id');
            $table->date('order_date');
            $table->string('name');
            $table->string('id_num');
            $table->string('mobile_num');
            $table->string('category');
            $table->foreignId('service_id');
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('expiry_date');
            $table->enum('status', ['جديد', 'مقبول', 'مرفوض', 'مدفوع', 'محجوز' ])->default('جديد');
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
        Schema::dropIfExists('rent_services');
    }
};