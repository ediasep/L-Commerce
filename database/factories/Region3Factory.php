<?php

use Faker\Generator as Faker;

$factory->define(App\Region3::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'country_id' => create('App\Country')->id,
        'region1_id' => create('App\Region1')->id,
        'region2_id' => create('App\Region2')->id,
    ];
});