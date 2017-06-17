<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillabl = ['name','file','date_publish','date_publish_finish','publish','download','categories_id'];

    protected $dates = ['date_publish','date_publish_finish'];
    public function category(){
        return $this->belongsTo(Category::class,'categories_id','id');
    }
}
