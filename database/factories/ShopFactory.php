<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'user_id' => create('App\User')->id,
        'logo' => $faker->imageUrl(640, 480, 'cats'),
    ];
});
