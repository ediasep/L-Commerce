<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GeneralSettingTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function admin_can_see_general_setting_page()
    {
       $this->adminSignIn();

       $this->get(route('admin.generalsetting'))
            ->assertSee($this->generalsetting->site_name)
            ->assertSee($this->generalsetting->site_title)
            ->assertSee($this->generalsetting->site_subtitle)
            ->assertSee($this->generalsetting->site_desc)
            ->assertSee($this->generalsetting->site_footer);
    }

    /** @test */
    public function admin_can_update_general_setting()
    {
       $this->adminSignIn();

       $new_generalsetting = make('App\GeneralSetting', ['site_name' => 'New Name']);

       $this->put(route('admin.generalsetting.update', $this->generalsetting->id), $new_generalsetting->toArray());

       $this->get(route('admin.generalsetting'))
            ->assertSee($new_generalsetting->site_name);
    }

    /** @test */
    public function general_setting_requires_site_name()
    {
       $this->adminSignIn();

       $this->withExceptionHandling();

       $new_generalsetting = make('App\GeneralSetting', ['site_name' => null]);

       $this->put(route('admin.generalsetting.update', $this->generalsetting->id), $new_generalsetting->toArray())
            ->assertSessionHasErrors('site_name');
    }
}
