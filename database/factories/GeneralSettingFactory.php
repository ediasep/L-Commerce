<?php

use Faker\Generator as Faker;

$factory->define(App\GeneralSetting::class, function (Faker $faker) {
    return [
        'site_name' => $faker->word,
        'site_title' => $faker->word,
        'site_subtitle' => $faker->sentence,
        'site_desc' => $faker->paragraph,
        'site_footer' => $faker->sentence,
    ];
});
