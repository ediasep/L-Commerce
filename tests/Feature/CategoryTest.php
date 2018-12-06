<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->category = create('App\Category');
    }

    /** @test */
    public function an_admin_can_create_category()
    {
        $this->adminSignIn();

        $category = make('App\Category');

        $this->post(route('category.store'), $category->toArray());

        $this->get(route('category.index'))
             ->assertSee($category->name);
    }

    /** @test */
    public function an_admin_can_update_category()
    {
        $this->adminSignIn();

        $category = create('App\Category', ['name' => 'Old Name']);
        $newCategory = make('App\Category', ['name' => 'New Name']);

        $this->put(route('category.update', $category->id), $newCategory->toArray());

        $this->get(route('category.edit', $category->id))
             ->assertSee($newCategory->name)
             ->assertDontSee($category->name);
    }

    /** @test */
    public function an_admin_can_delete_category()
    {
        $this->adminSignIn();

        $category = create('App\Category');

        $this->delete(route('category.destroy', $category->id));

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
