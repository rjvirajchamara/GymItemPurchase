<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymWorkOuts extends Model{
    public $connection = "mysql";

    public function trainrt_schedule(){
    return $this->hasMany(TrainrtScheduleWorkOut::class,'trainrt_id','trainer_id');
    }

    public function admin_schedule_work_outs(){
    return $this->hasMany(TrainrtScheduleWorkOut::class,'trainrt_id','trainer_id');
    }
}
