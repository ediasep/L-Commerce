<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShopTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_can_create_shop()
    {
    	$this->signIn();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $shop = make('App\Shop', ['id' => 1, 'image' => $file]);
        $this->post('/shop', $shop->toArray());

        $this->get('/shop/'.$shop->id)
             ->assertSee($shop->name)
             ->assertSee(str_limit($shop->description, 300, '...'))
             ->assertSee($file->hashName());
    }

    /** @test */
    public function an_authenticated_user_can_update_shop()
    {
    	$this->signIn();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $shop = create('App\Shop', ['name' => 'Old Name']);
        $shop_new = make('App\Shop', ['name' => 'New Name', 'image' => $file]);
        $this->put($shop->path(), $shop_new->toArray());

        $this->get($shop->path())
             ->assertSee($shop_new->name)
             ->assertSee($file->hashName());
    }

    /** @test */
    public function unauthenticated_user_cannot_create_shop()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $shop = make('App\Shop');
        $this->post('/shop', $shop->toArray());
    }

    /** @test */
    public function unauthenticated_user_cannot_edit_shop()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');

        $shop = create('App\Shop', ['name' => 'Old Name']);
        $shop_new = make('App\Shop', ['name' => 'New Name']);
        $this->put($shop->path(), $shop_new->toArray());
    }

    /** @test */
    public function a_shop_requires_name()
    {
    	$this->withExceptionHandling();
    	$this->signIn();

        $shop = make('App\Shop', ['name' => null]);
        $this->post('/shop', $shop->toArray())
        	 ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_shop_requires_name_when_update()
    {
    	$this->withExceptionHandling();
    	$this->signIn();

        $shop = create('App\Shop', ['name' => 'Old Name']);
        $shop_new = make('App\Shop', ['name' => null]);
        $this->put($shop->path(), $shop_new->toArray())
        	 ->assertSessionHasErrors('name');

    }

    /** @test */
    public function a_user_can_only_have_one_shop()
    {
		$this->withExceptionHandling();
    	$this->signIn();

        $shop = create('App\Shop', ['user_id' => 1]);
        $shop_new = make('App\Shop', ['user_id' => 1]);
        $this->post('/shop', $shop_new->toArray())
        	 ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function a_user_can_only_have_one_shop_update_validation()
    {
		$this->withExceptionHandling();
    	$this->signIn();

        $shop = create('App\Shop', ['user_id' => 1]);
        $shop_new = make('App\Shop', ['user_id' => 1]);
        $this->put($shop->path(), $shop_new->toArray())
        	 ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function user_can_see_shop_details_and_related_product()
    {
        $user = create('App\User');
        $shop = create('App\Shop', ['user_id' => $user->id]);
        $product = create('App\Product', ['user_id' => $user->id]);

        $this->get($shop->path())
             ->assertSee($shop->name)
             ->assertSee($shop->description)
             ->assertSee(str_limit($product->name, 40, '...'));


    }

    // TODO:
    // - If user already have shop, create form will redirected to edit form
}
