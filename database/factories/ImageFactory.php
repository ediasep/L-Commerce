<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(640, 480, 'cats'),
        'product_id' => create('App\Product')->id,
    ];
});
