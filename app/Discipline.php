<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ['initials','description','business_unit','created_at','update_at'];

    public function subDiscipline(){
        return $this->hasMany(SubDiscipline::class);
    }
}
