<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nurse_id');
            $table->integer('scheduler_id');
            $table->integer('patient_id');
            $table->string('nurse_start_time');
            $table->string('nurse_finish_time')->nullable();
            $table->string('nurse_start_lat');
            $table->string('nurse_start_lon');
            $table->string('estimate_distance_to_go_patient_home');
            $table->string('estimate_time_to_go_patient_home');
            $table->string('current_distance_covered')->nullable();
            $table->string('distance_required')->nullable();
            $table->string('time_required')->nullable();


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
        Schema::dropIfExists('nurse_statuses');
    }
}
