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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('main_classification',['مياه','مولد','صالة','مباني']);
            $table->string('service_description');
            $table->enum('subcategories',['شقة','حاصل','اخرى'])->nullable();
            $table->float('cost_amount');
            $table->enum('cost_type',['سنوي','شهري','يومي']);
            $table->foreignId('coin_id'); 
            $table->foreign('coin_id')->on('coins')->references('id')->cascadeOnDelete();
            $table->string('notes'); 
            $table->boolean('is_active');


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
        Schema::dropIfExists('services');
    }
};
