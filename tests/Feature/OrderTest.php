<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Order;
use App\OrderItem;
use cart;

class OrderTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function user_can_create_order()
    {
       $this->signIn();

       $seller = create('App\User');

       $product  = create('App\Product', ['user_id' => $seller->id]);
       $product2 = create('App\Product', ['user_id' => $seller->id]);

       $image  = create('App\Image', ['product_id' => $product->id]);
       $image2 = create('App\Image', ['product_id' => $product2->id]);

       $order_items = [
          1 => make('App\OrderItem', ['product_id' => $product->id])->toArray(),
          2 => make('App\OrderItem', ['product_id' => $product2->id])->toArray(),
       ];
       
       $order   = make('App\Order', ['customer_id' => auth()->id(), 'order_items' => $order_items]);
       $address = make('App\Address');
       $data    = array_merge($order->toArray(), $address->toArray());

       $this->post(route('order.store', $data));

       $this->signIn($seller);

       $this->get(route('order.sales'))
            ->assertSee($product->name)
            ->assertSee($product2->name);
    }

    /** @test */
    public function cart_will_be_destroyed_when_an_order_made()
    {
       $this->signIn();

       $order_items = [
          1 => make('App\OrderItem')->toArray(),
          2 => make('App\OrderItem')->toArray(),
       ];
       
       $order   = make('App\Order', ['customer_id' => auth()->id(), 'order_items' => $order_items]);
       $address = make('App\Address');

       $data = array_merge($order->toArray(), $address->toArray());

       $this->post(route('order.store', $data));

       $this->assertEquals(cart::count(), 0);
    }

    /** @test */
    public function user_can_see_transaction_details()
    {
      $this->signIn();

      $order = create('App\Order', ['customer_id' => auth()->id()]);

      $first_product  = create('App\Product');
      $second_product = create('App\Product');

      create('App\Image', ['product_id' => $first_product->id]);
      create('App\Image', ['product_id' => $second_product->id]);

      create('App\OrderItem', ['product_id' => $first_product->id, 'order_id' => $order->id]);
      create('App\OrderItem', ['product_id' => $second_product->id, 'order_id' => $order->id]);

      $this->get(route('order.show', $order->id))
           ->assertSee(str_limit($first_product->name, 20, '...'))
           ->assertSee(str_limit($second_product->name, 20, '...'));
    }

    /** @test */
    public function user_can_see_ordered_own_product() {
        $this->signIn();

        $product = create('App\Product', ['user_id' => auth()->id()]);
        $order   = create('App\Order');
        $item    = create('App\OrderItem', ['product_id' => $product->id, 'order_id' => $order->id]);

        $this->get(route('order.sales'))
             ->assertSee($product->name);
    }

    /** @test */
    public function when_user_order_multiple_product_from_different_seller_transaction_will_be_splitted() {
        $this->signIn();

        $seller_one = create('App\User');
        $seller_two = create('App\User');

        $product_one  = create('App\Product', ['user_id' => $seller_one->id]);
        $product_two  = create('App\Product', ['user_id' => $seller_two->id]);

        $order_items = [
          1 => make('App\OrderItem', ['product_id' => $product_one->id])->toArray(),
          2 => make('App\OrderItem', ['product_id' => $product_two->id])->toArray(),
        ];

        $order = make('App\Order', ['customer_id' => auth()->id(), 'order_items' => $order_items]);
        $address = make('App\Address');

        $this->post(route('order.store', array_merge($order->toArray(), $address->toArray())));

        $this->signIn($seller_one);
        $this->get(route('order.sales'))
             ->assertSee($product_one->name)
             ->assertDontSee($product_two->name);

        $this->signIn($seller_two);
        $this->get(route('order.sales'))
             ->assertSee($product_two->name)
             ->assertDontSee($product_one->name);
    }
}
