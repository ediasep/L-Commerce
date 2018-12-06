<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
    public function an_order_have_one_billing_address()
    {
        $address = create('App\Address');
        $order   = create('App\Order', ['billing_address_id' => $address->id]);

        $this->assertInstanceOf('App\Address', $order->billingAddress);
    }
}
