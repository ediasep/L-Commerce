<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
