<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddressTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
    public function an_address_belong_to_a_user() {
        $address = create('App\Address');

        $this->assertInstanceOf('App\User', $address->user);
    }

	/** @test */
    public function a_user_can_have_many_address() {
    	$user = create('App\User');
        $address = create('App\Address', ['user_id' => $user->id]);

        $this->assertTrue($user->addresses->contains($address));
    }
}
