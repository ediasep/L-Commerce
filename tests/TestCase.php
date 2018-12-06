<?php

namespace Tests;

use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // Create general setting
    public $generalsetting;
    public $localizationsetting;

    protected function setUp()
    {
        parent::setUp();
        $this->disableExceptionHandling();
        $this->generalsetting = create('App\GeneralSetting');
        $this->localizationsetting = create('App\LocalizationSetting');
    }
    protected function signIn($user = null)
    {
        $user = $user ?: create('App\User');
        $this->actingAs($user);
        return $this;
    }
    protected function adminSignIn($user = null) {
        $this->signIn($user);
        $role = create('App\Role', ['name' => 'admin']);
        create('App\RoleUser', ['user_id' => auth()->id(), 'role_id' => $role->id]);
    }
    // Hat tip, @adamwathan.
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }
    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }
}
