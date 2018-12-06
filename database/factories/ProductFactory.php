<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name,
        'description' => $faker->paragraph(10),
        'user_id' => create('App\User')->id,
        'price' => $faker->randomNumber(2),
        'shop_id' => create('App\Shop')->id,
        'category_id' => create('App\Category')->id,
        'slug' => createSlug($name)
    ];
});
