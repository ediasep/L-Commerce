<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'user_id'            => create('App\User')->id,
        'address_name'       => $faker->word,
        'first_name'         => $faker->firstName,
        'last_name'          => $faker->lastName,
        'email'              => $faker->email,
        'phone'              => $faker->phoneNumber,
        'full_address'       => $faker->address,
        'suburb_or_town'     => $faker->city,
        'state_or_territory' => $faker->word,
        'post_code'          => $faker->postcode,
        'is_main_address'    => $faker->boolean,
    ];
});
