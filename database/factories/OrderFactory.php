<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'customer_id' => create('App\User')->id,
        'billing_address_id'  => create('App\Address')->id
    ];
});
