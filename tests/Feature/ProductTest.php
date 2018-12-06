<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Image;

class ProductTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_products()
    {
       $product = create('App\Product');

       $this->get(route('product.show', $product->slug))
            ->assertSee($product->name)
            ->assertSee($product->image_url)
            ->assertSee($product->price);
    }

    /** @test */
    public function a_user_can_view_product_details()
    {
       $product = create('App\Product');

       $this->get('/product/'.$product->slug)
            ->assertSee($product->name)
            ->assertSee($product->image_url)
            ->assertSee($product->price)
            ->assertSee($product->description);
    }

    /** @test */
    public function an_authenticated_user_can_create_product()
    {
        $this->signIn();

        $files = [
            UploadedFile::fake()->image('product1.jpg')
        ];

        $product = make('App\Product', ['images' => $files]);
        $response = $this->post('/product', $product->toArray());

        $this->get(route('product.show', $product->slug))
             ->assertSee($product->name)
             ->assertSee($product->description)
             ->assertSee($product->price);
    }

    /** @test */
    public function a_product_requires_a_name_price_shopid_categoryid_description_images(){
        $this->withExceptionHandling();
        $this->signIn();
        $product  = make('App\Product', ['name' => null, 'price' => null, 'shop_id' => null, 'category_id' => null, 'description' => null, 'images' => null]);

        $this->post('/product', $product->toArray())
             ->assertSessionHasErrors('name')
             ->assertSessionHasErrors('price')
             ->assertSessionHasErrors('category_id')
             ->assertSessionHasErrors('description')
             ->assertSessionHasErrors('images');
    }

    /** @test */
    public function unauthenticated_user_cannot_create_product()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $product   = make('App\Product');
        $this->post('/product', $product->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_update_product()
    {
        $this->signIn();

        $files = [
            UploadedFile::fake()->image('product1.jpg')
        ];

        $product = create('App\Product', ['name' => 'Old Name', 'slug' => 'hello-world']);
        $product_new = make('App\Product', ['name' => 'New Name', 'slug' => 'hello-world', 'images' => $files ]);
        $this->put($product->path(), $product_new->toArray());

        $this->get($product->path())
             ->assertSee($product_new->name);
    }

    /** @test */
    public function unauthenticated_user_cannot_edit_product()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $product = create('App\Product', ['name' => 'Old Name', 'slug' => 'hello-world']);
        $product_new = make('App\Product', ['name' => 'New Name', 'slug' => 'hello-world']);
        $this->put($product->path(), $product_new->toArray());
    }

    /** @test */
    public function authenticated_user_can_remove_his_own_product()
    {
        $this->signIn();

        $product = create('App\Product', ['user_id' => auth()->id()]);
        $this->delete(route('product.destroy', $product->slug));

        $this->assertSoftDeleted('products', $product->toArray());
    }

    /** @test */
    public function unauthenticated_user_cannot_remove_his_own_product()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $product = create('App\Product');
        $this->delete(route('product.destroy', $product->slug));
    }

    /** @test */
    public function authenticated_user_cannot_remove_product_owned_by_other_user()
    {
        $user = create('App\User', ['id' => 1]);
        $this->signIn($user);

        $product = create('App\Product', ['user_id' => 2]);
        $this->delete(route('product.destroy', $product->slug));

        $this->assertDatabaseHas('products', $product->toArray());
    }

    /** @test */
    public function user_can_filter_product_by_username()
    {
        $user = create('App\User');

        $product = create('App\Product', ['user_id' => $user->id]);

        $this->get('product?by='.$user->name)
             ->assertSee(str_limit($product->name, 40, '...'))
             ->assertSee($product->price);
    }

    /** @test */
    public function user_can_filter_product_by_category()
    {
        $user = create('App\User');

        $product = create('App\Product', ['user_id' => $user->id]);

        $this->get('product?category='.$product->category->slug)
             ->assertSee(str_limit($product->name, 40, '...'))
             ->assertSee($product->price);
    }

    /** @test */
    public function test_when_product_updated_images_will_updated_accordingly()
    {

        $this->signIn();

        $files = [
            UploadedFile::fake()->image('product1.jpg')
        ];

        $product = make('App\Product', ['images' => $files]);
        $response = $this->post('/product', $product->toArray());

        $this->get(route('product.show', $product->slug))
             ->assertSee($product->name)
             ->assertSee($product->description)
             ->assertSee($product->price);

        $files_new = [
            UploadedFile::fake()->image('product1.jpg'),
            UploadedFile::fake()->image('product2.jpg'),
            UploadedFile::fake()->image('product3.jpg'),
            UploadedFile::fake()->image('product4.jpg'),
            UploadedFile::fake()->image('product5.jpg')
        ];

        $product  = Product::where('name', $product->name)->first();

        $product_new  = make('App\Product', ['images' => $files_new, 'slug' => $product->slug]);

        $response = $this->put(route('product.update', $product->slug), $product_new->toArray());

        $this->get(route('product.show', $product_new->slug))
             ->assertSee($product_new->name);

        $images = Image::where('product_id', $product->id)
                  ->orderBy('id')->get();

        $this->assertEquals(5, $images->count());

        $this->assertEquals('/storage/images/'.$files_new[0]->hashName(), $images->first()->url);

        Storage::disk('public')->assertMissing('images/'.$files[0]->hashName());
    }
}
