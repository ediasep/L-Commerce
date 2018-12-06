<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Image extends Model
{

	public $fillable = ['url', 'product_id'];

    public function product() {
    	return $this->belongsTo('App\Product');
    }

    public static function upload_product_images($product_id, $existings = null) {
        if(!request()->hasFile('images')) {
            return false;
        }

        foreach (request()->file('images') as $key => $image) {
            Storage::disk('public')->put('images/', $image);

            self::save_image($product_id, $key, $image);
        }
    }

    public static function save_image($product_id, $key, $image) {
    	$img = Image::where(['product_id' => $product_id])->skip($key)->take(1)->first();

    	if($img) {
    		$filename = str_replace('/storage/', '', $img->url);

    		Storage::disk('public')->delete($filename);

    		$img->url = '/storage/images/'.$image->hashName();
    		$img->save();
    	} else {
	        Image::create([
	            'url' => '/storage/images/'.$image->hashName(),
	            'product_id' => $product_id,
	        ]);
    	}
    }
}
