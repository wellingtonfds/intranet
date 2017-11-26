<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','featured','content','status_post_id','views','user_id'];


    public function status(){
        return $this->belongsTo(StatusPost::class,'status_post_id');
    }
}
