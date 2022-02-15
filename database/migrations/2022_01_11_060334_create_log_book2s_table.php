<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogBook2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_book2s', function (Blueprint $table) {
            $table->id();
            $table->string('requestno');
            $table->string('admin_name')->nullable();
            $table->string('visiting_date')->nullable();
            $table->string('morning_start')->nullable();
            $table->string('morning_end')->nullable();
            $table->string('afternoon_start')->nullable();
            $table->string('afternoon_end')->nullable();
            $table->longText('personnels')->nullable();
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
        Schema::dropIfExists('log_book2s');
    }
}
