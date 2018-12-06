<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	public $fillable = ['order_id', 'product_id', 'quantity'];

	public function Order()
	{
		return $this->belongsTo('App\Order');
	}

	public function Product()
	{
		return $this->belongsTo('App\Product');
	}
}