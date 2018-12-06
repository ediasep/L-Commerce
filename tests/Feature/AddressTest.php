<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Address;

class AddressTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
    public function authenticated_user_can_create_address()
    {
    	$this->signIn();

    	$address = make('App\Address', ['id' => 1]);

    	$response = $this->post(route('address.store'), $address->toArray());

    	$this->get(route('address.show', $address->id))
    		 ->assertSee($address->address_name);
    }

    /** @test */
    public function unauthenticated_user_cannot_create_address()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $address = make('App\Address', ['id' => 1]);

        $response = $this->post(route('address.store'), $address->toArray());

        $this->get(route('address.show', $address->id))
             ->assertSee($address->address_name);
    }

    /** @test */
    public function authenticated_user_can_remove_his_own_address()
    {
        $this->signIn();

        $address = create('App\Address', ['user_id' => auth()->id()]);
        $this->delete(route('address.destroy', $address->id));

        $this->assertSoftDeleted('addresses', $address->toArray());
    }

    /** @test */
    public function unauthenticated_user_cannot_remove_address()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $address = create('App\Address', ['user_id' => 1]);
        $this->delete(route('address.destroy', $address->id));
    }

    /** @test */
    public function authenticated_user_can_update_address()
    {
        $this->signIn();

        $address = create('App\Address', ['address_name' => 'old name']);
        $address_new = make('App\Address', ['address_name' => 'new name']);

        $response = $this->put(route('address.update', $address->id), $address_new->toArray());

        $this->get(route('address.show', $address->id))
             ->assertSee($address_new->address_name);
    }

    /** @test */
    public function user_can_set_address_as_main_address()
    {
        $this->signIn();

        $address = create('App\Address');
        $this->put(route('address.set_main_address', $address->id));
        $created_address = Address::where('id', $address->id)->first();

        $this->assertEquals($created_address->is_main_address, true);
    }

    /** @test */
    public function everytime_user_create_address_for_the_first_time_it_will_used_as_main_address()
    {
        $this->signIn();

        $address  = make('App\Address', ['id' => 1]);
        $this->post(route('address.store'), $address->toArray());
        $created_address = Address::where(['user_id' => auth()->id(), 'id' => $address->id])->first();
        $this->assertEquals($created_address->is_main_address, true);

        $address_new  = make('App\Address', ['id' => 2]);
        $this->post(route('address.store'), $address->toArray());
        $created_address_new = Address::where(['user_id' => auth()->id(), 'id' => $address_new->id])->first();
        $this->assertEquals($created_address_new->is_main_address, false);
    }
}
