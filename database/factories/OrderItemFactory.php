<?php

use Faker\Generator as Faker;

$factory->define(App\OrderItem::class, function (Faker $faker) {
    return [
        'order_id'    => create('App\Order')->id,
        'product_id'  => create('App\Product')->id,
        'quantity'    => $faker->randomDigit,
    ];
});
