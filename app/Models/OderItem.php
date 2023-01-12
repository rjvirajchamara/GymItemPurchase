<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OderItem extends Model{

    public function itemdetails(){
    return $this->hasMany(ItemOder::class,'oder_id','id');
    }
 

}
