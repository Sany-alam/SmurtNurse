<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseAssesmentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_assesment_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('scheduler_id');
            $table->string('t1_q1_answer');
            $table->string('t1_q2_answer');
            $table->string('t1_q3_answer');
            $table->string('t2_q1_answer');
            $table->string('t2_q2_answer');
            $table->string('t2_q3_answer');
            $table->string('narrative_note_answer');
            $table->integer('status');

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
        Schema::dropIfExists('nurse_assesment_forms');
    }
}
