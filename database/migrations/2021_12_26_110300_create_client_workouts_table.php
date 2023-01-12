<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_workouts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('work_outs_id');
            $table->string('day');
            $table->integer('active');
            $table->integer('trainrt_id');
            $table->string('schedule_name');
            $table->text('schedule_discription');
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
        Schema::dropIfExists('client_workouts');
    }
}
