<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function user_can_see_edit_account_page()
    {
    	$this->signIn();

        $this->get(route('account'))
        	 ->assertSee(auth()->user()->name)
        	 ->assertSee(auth()->user()->email);
    }

    /** @test */
    public function user_can_update_account()
    {
    	$this->signIn();

    	$user = make('App\User', ['name' => 'New Name', 'email' => auth()->user()->email, 'password' => 'New Password', 'password_confirmation' => 'New Password']);

    	$this->put(route('account.update'), $user->makeVisible('password')->toArray());

    	$this->get(route('account'))
    		 ->assertSee($user->name);

        $updated_user = User::find(auth()->id());

        $this->assertTrue(Hash::check('New Password', $updated_user->password));
    }

    /** @test */
    public function when_updating_password_repeat_password_should_match()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $user = make('App\User', ['name' => 'New Name', 'email' => auth()->user()->email, 'password' => 'New Password', 'password_confirmation' => null]);

        $this->put(route('account.update'), $user->makeVisible('password')->toArray())
             ->assertSessionHasErrors('password');
    }

    /** @test */
    public function only_update_password_if_password_column_filled()
    {
        $old_user = create('App\User', ['password' => Hash::make('Hello Password')]);
        $this->signIn($old_user);

        $user = make('App\User', ['name' => 'New Name', 'email' => auth()->user()->email, 'password' => null, 'password_confirmation' => null]);

        $this->put(route('account.update'), $user->makeVisible('password')->toArray());

        $updated_user = User::find(auth()->id());

        $this->assertTrue(Hash::check('Hello Password', $updated_user->password));
    }
}
