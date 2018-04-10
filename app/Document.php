<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'type','discipline_id','sub_discipline_id','categorization_id',
        'sequential','review','title','file','created_at','updated_at'
    ];

    public function Discipline(){
        return $this->belongsTo(Discipline::class);
    }
    public function SubDiscipline(){
        return $this->belongsTo(SubDiscipline::class);
    }
    public function Category(){
        return $this->belongsTo(Categorization::class,'categorization_id');
    }


}
