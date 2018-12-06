<?php

use Faker\Generator as Faker;

$factory->define(App\Region1::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'country_id' => create('App\Country')->id,
    ];
});