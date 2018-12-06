<?php

use Illuminate\Database\Seeder;
use App\GeneralSetting;
use App\LocalizationSetting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::create([
        	'id' => 1,
        	'site_name' => 'Laracommerce',
        	'site_title' => 'Laravel Multivendor Marketplace',
        	'site_subtitle' => 'Your Awesome Marketplace',
        	'site_desc' => 'Buy . Sell . LOL',
            'site_footer' => '© Copyright 2016 - City of USA. All rights reserved.'
        ]);

        LocalizationSetting::create([
            'id' => 1,
            'language' => 'en',
            'currency' => 'USD',
        ]);
    }
}
