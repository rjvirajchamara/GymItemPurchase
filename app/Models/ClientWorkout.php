<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Library;

class ClientWorkout extends Model
{
    public $connection = "mysql";
   public function Workout(){

   return $this->hasMany(GymWorkOuts::class,'id','work_outs_id');
   }



   public function trainrt_schedule_work_outs(){

    return $this->hasMany(TrainrtScheduleWorkOut::class,'work_out_id','work_outs_id');
    }

    public function trainrt_schedule_libraries_count(){
        return $this->hasMany(TrainrtScheduleWorkOut::class,'work_out_id','work_outs_id');
         
    }
    public function process(){
        return $this->hasMany(ClientDailyWorkoutDetlis::class,'work_outs_id','work_outs_id');

    }


}
