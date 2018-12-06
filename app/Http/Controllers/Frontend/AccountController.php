<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AccountController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('frontend.account', compact('user'));
    }

    /**
     * Update Account
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $this->validate(request(), [
            'password' => 'confirmed'
        ]);

        $user = auth()->user();
        $user->name = request('name');

        if(request('password')) {
            $user->password = Hash::make(request('password'));
        }
        
        $user->save();

        return redirect()->route('account')->with('flash', 'Account has been successfully updated');
    }
}
