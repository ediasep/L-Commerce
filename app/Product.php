<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

	public $fillable = ['name', 'description', 'user_id', 'price', 'category_id', 'image_url', 'slug', 'shop_id'];

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}

    public function path() {
        return "/product/{$this->slug}";
    }

    public function images() {
    	return $this->hasMany('App\Image');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function thumbnailUrl() {
        $first_image = $this->images->first();
        return $first_image ? $first_image->url : '';
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function vendor() {
        $shop_name = $this->user->shop->name;
        $vendor    = $shop_name ? $shop_name : $this->user->name;

        return $vendor;
    }

    public function vendor_url() {
        $shop_id = $this->user->shop->id;
        $url     = $shop_id ? route('shop.show', $shop_id) : null;

        return $url;
    }

    public function scopeFilter($query, $filters) {
        return $filters->apply($query);
    }

    public function scopeGetUserId($query, $product_id)
    {
        return $query->select('user_id')
                     ->where('id', $product_id)
                     ->first()
                     ->user_id;
    }
}
