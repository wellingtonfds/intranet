<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorization extends Model
{
    protected  $fillable = [
        'description','discipline_id','sub_discipline_id','created_at','updated_at'
    ];
}
