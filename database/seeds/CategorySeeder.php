<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'   => 1,
            'name' => 'Smartwatch',
            'slug' => 'smartwatch',
        ]);

        Category::create([
            'id'   => 2,
            'name' => 'Smartphone',
            'slug' => 'smartphone',
        ]);

        Category::create([
            'id'   => 3,
            'name' => 'Smart TV',
            'slug' => 'smart-tv',
        ]);

        Category::create([
            'id'   => 4,
            'name' => 'Iphone',
            'slug' => 'iphone',
        ]);

        Category::create([
            'id'   => 5,
            'name' => 'Laptop',
            'slug' => 'laptop',
        ]);
    }
}
