<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDailyWorkoutDetlis extends Model
{
    public function getrainer_name(){
        return $this->belongsTo(Trainer::class,'trainrt_id','id');
        }
}
