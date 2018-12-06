<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function admin_can_see_admin_page()
    {
        $this->signIn();

        $role = create('App\Role', ['name' => 'admin']);
        $roleUser = create('App\RoleUser', ['user_id' => auth()->id(), 'role_id' => $role->id]);

        $this->get(route('dashboard.index'))
        	 ->assertStatus(200);
    }

    /** @test */
    public function non_admin_can_see_admin_page()
    {

    	$this->expectException('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');

        $this->signIn();

        $role = create('App\Role', ['name' => 'user']);
        $roleUser = create('App\RoleUser', ['user_id' => auth()->id(), 'role_id' => $role->id]);

        $this->get(route('dashboard.index'));
    }
}
