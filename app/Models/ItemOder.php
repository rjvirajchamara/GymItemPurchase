<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOder extends Model
{
    public function productdetails(){
    return $this->hasMany(item::class,'id','item_id');
    }
}
