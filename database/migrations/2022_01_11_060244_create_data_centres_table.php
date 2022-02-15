<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_centres', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('room1');
            $table->string('room2');
            $table->string('room3');
            $table->string('room4');
            $table->string('room5');
            $table->string('room6');
            $table->string('room7');
            $table->string('room8');
            $table->string('room9');
            $table->string('room10');
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
        Schema::dropIfExists('data_centres');
    }
}
