<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDailyWorkoutDetlisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_daily_workout_detlis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('schedule_count');
            $table->string('day');
            $table->text('feedback');
            $table->decimal('progress');
            $table->integer('work_outs_id');
            $table->integer('trainrt_id');
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
        Schema::dropIfExists('client_daily_workout_detlis');
    }
}
