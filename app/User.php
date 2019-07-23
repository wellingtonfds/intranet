<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword; // Insert trait here

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        $roles = "";
        foreach ($this->roles as $role){
            $roles .= $role->name." ";
        }
        return $roles;
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {

        return $this->hasAnyroles($permission->roles);

    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles())->count();
        }
        return $this->roles()->get()->contains('name', $roles);
    }

    /**
     * @return mixed
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
