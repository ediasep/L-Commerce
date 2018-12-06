<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ImageTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
    public function image_will_be_stored_when_provided_while_storing_product()
    {
    	$this->signIn();

        Storage::fake('public');

        $files = [
        	UploadedFile::fake()->image('product1.jpg')
        ];

        $product = make('App\Product', ['images' => $files]);

        $this->post(route('product.store'), $product->toArray());

        Storage::disk('public')->assertExists('images/' . $files[0]->hashName());
    }

	/** @test */
    public function a_product_can_have_multiple_images() {
        $product = create('App\Product');
        $image   = create('App\Image', ['product_id' => $product->id]);

        $this->assertTrue($product->images->contains($image));
    }

    /** @test */
    public function user_can_remove_his_own_image()
    {
        $this->signIn();

        $product = create('App\Product', ['id' => 1, 'user_id' => auth()->id()]);
        $image   = create('App\Image', ['product_id' => $product->id]);

        $this->delete(route('image.destroy', $image->id));

        $this->assertDatabaseMissing('images', ['id' => $image->id, 'url' => $image->url]);
    }

    /** @test */
    public function user_cannot_remove_image_not_owned_by_the_user()
    {
        $this->signIn();

        $product = create('App\Product', ['id' => 1, 'user_id' => (auth()->id() + 1)]);
        $image   = create('App\Image', ['product_id' => $product->id]);

        $this->delete(route('image.destroy', $image->id));

        $this->assertDatabaseHas('images', ['id' => $image->id, 'url' => $image->url]);
    }
}
