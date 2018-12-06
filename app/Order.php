<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Address;

class Order extends Model
{
	public $fillable = ['customer_id', 'billing_address_id'];

	public function Customer()
	{
		return $this->belongsTo('App\User', 'customer_id');
	}

	public function items()
	{
		return $this->hasMany('App\OrderItem');
	}

	public function totalPrice()
	{
		$total = 0;
		foreach ($this->items as $item) {
			$total += $item->Product->price;
		}

		echo $total;
	}

	public function billingAddress()
	{
		return $this->belongsTo('App\Address', 'billing_address_id')->withTrashed();
	}

	public function scopeSeller($query, $user_id)
	{
		return $query->select('orders.id', 'orders.customer_id')
					 ->join('order_items', 'order_items.order_id', '=', 'orders.id')
					 ->join('products', 'order_items.product_id', '=', 'products.id')
					 ->where('products.user_id', $user_id);
	}

	public function scopeBuyer($query, $user_id)
	{
		return $query->where('customer_id', $user_id);
	}

	public function scopeTransactionCount($query, $user_id)
	{
		return $query->where('customer_id', $user_id)->count();
	}

	public function scopeSalesCount($query, $user_id)
	{
		return $query->select('orders.id', 'orders.customer_id')
					 ->join('order_items', 'order_items.order_id', '=', 'orders.id')
					 ->join('products', 'order_items.product_id', '=', 'products.id')
					 ->where('products.user_id', $user_id)->count();
	}

    public function createOrder($request)
    {
        $seller_id = null;

        foreach ($request->order_items as $item) {
            $user_id = Product::getUserId($item['product_id']);

            if($user_id != $seller_id)
            {
                $order = Order::create([    
                    'customer_id'        => auth()->id(),
                    'billing_address_id' => $request->billing_address_id,
                ]);
            }

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
            ]);

        }
    }
}