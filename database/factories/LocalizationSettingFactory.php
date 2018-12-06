<?php

use Faker\Generator as Faker;

$factory->define(App\LocalizationSetting::class, function (Faker $faker) {
    return [
        'language' => $faker->languageCode,
        'currency' => $faker->currencyCode,
    ];
});
