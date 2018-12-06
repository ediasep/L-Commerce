<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	public $fillable = ['name', 'slug'];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function scopeSearchId($query, $param) {
    	$category = $query->where('slug', $param)
    					  ->orWhere('name', 'like', '%'.$param.'%')
    					  ->first();

    	return $category ? $category->id : false;
    }
}
