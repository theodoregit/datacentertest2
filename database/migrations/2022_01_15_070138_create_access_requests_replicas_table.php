<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessRequestsReplicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_requests_replicas', function (Blueprint $table) {
            $table->id();
            $table->string('requestno')->default('0');
            $table->string('fullname');
            $table->string('phone_number');
            $table->integer('id_number');
            $table->date('date');
            $table->string('starting_date');
            $table->string('end_date');
            $table->integer('visiting_days');
            $table->integer('remaining_days');
            $table->string('access_req_location');
            $table->string('access_time');
            $table->string('areas_tobe_accessed');
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
            $table->string('letter');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('access_requests_replicas');
    }
}
