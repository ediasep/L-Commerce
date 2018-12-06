<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoleTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
    public function a_user_can_have_multiple_roles() {
        $user = create('App\User');
        $role = create('App\Role');
        $role_user = create('App\RoleUser', ['user_id' => $user->id, 'role_id' => $role->id]);

        $this->assertTrue($user->roles->contains($role));
    }

	/** @test */
    public function a_role_can_have_multiple_users() {
        $user = create('App\User');
        $role = create('App\Role');
        $role_user = create('App\RoleUser', ['user_id' => $user->id, 'role_id' => $role->id]);

        $this->assertTrue($user->roles->contains($role));
    }
}
