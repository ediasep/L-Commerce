<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function region1s() {
    	return $this->hasMany('App\Region1');
    }

    public function region2s() {
    	return $this->hasMany('App\Region2');
    }

    public function region3s() {
    	return $this->hasMany('App\Region3');
    }
}
