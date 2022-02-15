<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_requests', function (Blueprint $table) {
            $table->id();
            $table->string('requestno')->default('0');
            $table->string('fullname');
            $table->string('phone_number');
            $table->string('email');
            $table->string('id_number');
            $table->date('date');
            $table->string('starting_date');
            $table->string('end_date');
            $table->integer('visiting_days');
            $table->integer('remaining_days');
            $table->string('addis_ababa_branch');
            $table->string('kera_gofa_branch');
            $table->string('access_time');
            $table->string('personnel1')->nullable();
            $table->string('personnel2')->nullable();
            $table->string('personnel3')->nullable();
            $table->string('personnel4')->nullable();
            $table->string('personnel5')->nullable();
            $table->string('personnel6')->nullable();
            $table->string('personnel7')->nullable();
            $table->string('personnel8')->nullable();
            $table->string('personnel9')->nullable();
            $table->string('personnel10')->nullable();
            $table->string('escortingteam');
            $table->longText('escorts');
            $table->string('location');
            $table->longText('impact');
            $table->longText('purpose');
            $table->integer('status'); //0 for pending, 1 for confirmed, 2 for denied, 3 for granted ...
            $table->boolean('is_confirmed')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_denied')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->string('unit');
            $table->longText('denial_reason');
            $table->longText('rejection_reason');
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
        Schema::dropIfExists('access_requests');
    }
}
