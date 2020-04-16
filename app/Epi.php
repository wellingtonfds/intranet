<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epi extends Model
{
    protected $fillable = ['cc','meta'];
    protected $casts = ['meta'=>'array'];

    public function scopeCenterOfCost($query, $cc)
    {
        return $query->where('cc',$cc);
    }
}
