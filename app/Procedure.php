<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $hidden = ['text'];
    protected $fillable = ['name','file','date_publish','date_publish_finish','publish','download','categories_id'];
    protected $dates = ['date_publish','date_publish_finish'];
    public function category(){
        return $this->belongsTo(Category::class,'categories_id','id');
    }

    public function revisions(){
        return $this->hasMany(Revision::class,'procedures_id');
    }
    public function lastRevision(){
        $revisions = $this->revisions();
        $id =  $revisions->max('id');
        return  $revisions->where('id',$id)->get();
    }

    public function step(){
        $step = $this->lastRevision();
        if(empty($step[0]->reviewed_date))
            return 'revisão pendente';
        if(empty($step[0]->approved_date)){
            return 'Aprovação pendente';
        }else{
            return 'Aprovado';
        }


    }
}
