<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDiscipline extends Model
{
    protected $fillable = ['initial','description','discipline_id','created_at','updated_at'];
}
