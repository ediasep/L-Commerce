<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LocalizationSettingTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function admin_can_see_localization_setting_page()
    {
    	$this->adminSignIn();

    	$this->get(route('admin.localizationsetting'))
    		 ->assertSee($this->localizationsetting->language)
    		 ->assertSee($this->localizationsetting->currency);
    }

    /** @test */
    public function admin_can_update_localization_setting()
    {
    	$this->adminSignIn();

    	$locale_new = make('App\LocalizationSetting', ['language' => 'new', 'currency' => 'new']);

    	$this->put(route('admin.localizationsetting.update', $this->localizationsetting->id), $locale_new->toArray());

    	$this->get(route('admin.localizationsetting'))
    		 ->assertSee($locale_new->language)
    		 ->assertSee($locale_new->currency);
    }

    /** @test */
    public function general_setting_requires_language_and_currency()
    {
       $this->adminSignIn();

       $this->withExceptionHandling();

       $this->localizationsetting;

       $locale_new = make('App\LocalizationSetting', ['language' => null, 'currency' => null]);

       $this->put(route('admin.localizationsetting.update', $this->localizationsetting->id), $locale_new->toArray())
            ->assertSessionHasErrors('language')
            ->assertSessionHasErrors('currency');
    }
}
