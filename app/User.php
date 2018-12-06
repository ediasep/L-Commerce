<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function shop() {
        return $this->hasOne('App\Shop')->withDefault();
    }

    public function addresses() {
        return $this->hasMany('App\Address');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function roles() {
    	return $this->belongsToMany('App\Role');
    }

    public function hasRole($role_name) {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $role_name)
            {
                return true;
            }
        }

        return false;
    }
}
