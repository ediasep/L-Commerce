<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	public $fillable = ['name', 'description', 'address', 'user_id'];

    public function path(){
    	return "/shop/{$this->id}";
    }

    public function user() {
        return $this->belongsTo('App\User')->withDefault();
    }
}
