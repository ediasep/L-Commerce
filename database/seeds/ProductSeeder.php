<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        	'id'          => 1,
	        'name'        => 'Iphone X 64 GB',
	        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	        'user_id' => 1,
	        'price' => 900,
	        'shop_id' => null,
	        'category_id' => 4,
	        'slug' => createSlug('Iphone X 64 GB')
        ]);

        Product::create([
        	'id'          => 2,
	        'name'        => 'Macbook Pro Retina Display',
	        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	        'user_id' => 1,
	        'price' => 1100,
	        'shop_id' => null,
	        'category_id' => 5,
	        'slug' => createSlug('Macbook Pro Retina Display')
        ]);

        Product::create([
        	'id'          => 3,
	        'name'        => 'Asus ROG 19 inch',
	        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	        'user_id' => 1,
	        'price' => 1050,
	        'shop_id' => null,
	        'category_id' => 5,
	        'slug' => createSlug('Asus ROG 19 inch')
        ]);

        Product::create([
        	'id'          => 4,
	        'name'        => 'G9 Pro Android and IOS Smartwatch',
	        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	        'user_id' => 1,
	        'price' => 600,
	        'shop_id' => null,
	        'category_id' => 1,
	        'slug' => createSlug('G9 Pro Android and IOS Smartwatch')
        ]);

        Product::create([
        	'id'          => 5,
	        'name'        => 'Ultra HD Smart Television',
	        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	        'user_id' => 1,
	        'price' => 750,
	        'shop_id' => null,
	        'category_id' => 3,
	        'slug' => createSlug('Ultra HD Smart Television')
        ]);

        Product::create([
        	'id'          => 6,
	        'name'        => 'Bluetooth Wireless Headphone',
	        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	        'user_id' => 1,
	        'price' => 150,
	        'shop_id' => null,
	        'category_id' => 2,
	        'slug' => createSlug('Bluetooth Wireless Headphone')
        ]);
    }
}
