<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id');
            $table->string('thumbnail');
            $table->text('description');
            $table->text('alamat');
            $table->string('whatsapp_number');
            // $table->string('sub_district'); //Cibereum
            $table->integer('price'); // 4juta/4000000
            $table->string('code'); // CBM-DA001
            $table->boolean('is_recommendation')->default(false);
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
        Schema::dropIfExists('villas');
    }
}
