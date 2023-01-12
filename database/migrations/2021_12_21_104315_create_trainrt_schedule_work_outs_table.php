<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainrtScheduleWorkOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainrt_schedule_work_outs', function (Blueprint $table) {
            $table->id();
            $table->integer('trainrt_id');
            $table->integer('work_out_id');
            $table->integer('libraries_id');


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
        Schema::dropIfExists('trainrt_schedule_work_outs');
    }
}
