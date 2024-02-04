<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillaFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villa_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('villa_id')->constrained()->onDelete('cascade');
            $table->foreignId('fasilitas_id');
            $table->string('value')->nullable(); //cth. 7, ini diper-untukan buat icon yg ada valuenya misal 4 kamar, 7 orang) 
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
        Schema::dropIfExists('villa_facilities');
    }
}
