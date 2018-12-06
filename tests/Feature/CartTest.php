<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Cart;

class CartTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
    public function an_anonymous_user_can_add_product_to_cart()
    {
    	$product = create('App\Product');
        $image   = create('App\Image', ['product_id' => $product->id]);
    	$this->get(route('cart.create', $product->slug));
    	$this->get(route('cart.index'))
    		 ->assertSee($product->name)
    		 ->assertSee('$ '.$product->price);
    }

	/** @test */
    public function an_anonymous_user_can_remove_product_from_cart()
    {
    	$product = create('App\Product');
        $image   = create('App\Image', ['product_id' => $product->id]);
    	$this->get(route('cart.create', $product->slug));

    	$items = Cart::content();

    	foreach ($items as $item) {
    		$this->get(route('cart.destroy', $item->rowId));
    	}

    	$this->get(route('cart.index'))
    		 ->assertDontSee($product->name)
    		 ->assertDontSee('$ '.$product->price);
    }

	/** @test */
    public function an_anonymous_user_can_update_quantity_from_cart()
    {
    	$product = create('App\Product');
        $image   = create('App\Image', ['product_id' => $product->id]);
    	$this->get(route('cart.create', $product->slug));

    	$items = Cart::content();

    	foreach ($items as $item) {
    		$this->put(route('cart.update', $item->rowId), ['qty' => 100]);
    	}

    	$items = Cart::content();

    	foreach ($items as $item) {
	    	$this->assertEquals($item->qty, 100);
    	}
    }

	/** @test */
    public function if_cart_is_empty_then_show_empty_message()
    {
    	Cart::destroy();

       $this->assertEquals(cart::count(), 0);
    }

    /** @test */
    public function when_checkout_address_will_only_initialize_if_user_login()
    {

    }
}
