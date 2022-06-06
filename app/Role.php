<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @return mixed
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
