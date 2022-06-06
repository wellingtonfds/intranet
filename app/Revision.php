<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'description', 'elaborate', 'reviewed', 'approved',
        'elaborate_date', 'reviewed_date', 'approved_date',
        'version','procedures_id'
    ];

    /**
     * @return mixed
     */
    public function procedure(){
        return $this->belongsTo(Procedure::class);
    }

}
