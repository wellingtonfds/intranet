<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $fillable = [
        'description', 'elaborate', 'reviewed', 'approved',
        'elaborate_date', 'reviewed_date', 'approved_date',
        'version','procedures_id'
    ];

    public function procedure(){
        return $this->belongsTo(Procedure::class);
    }

}
