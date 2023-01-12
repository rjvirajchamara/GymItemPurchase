<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TrainrtScheduleWorkOut extends Model
{
    public $connection = "mysql";

    public function librarie(){
    return $this->hasMany(libraries::class,'id','libraries_id');
    }

    public function trainrt_schedule_libraries_count(){
    return $this->hasMany(libraries::class,'id','libraries_id');
   // DB::raw("count(libraries_id) as count");

    }
    public function getTrainer(){
    return $this->belongsTo(Trainer::class,'trainrt_id','id');
    }
    }


