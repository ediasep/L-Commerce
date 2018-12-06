<?php

use Faker\Generator as Faker;

$factory->define(App\RoleUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'role_id' => $faker->randomDigit
    ];
});
