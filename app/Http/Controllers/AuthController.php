<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\AuthStoreRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

	
    public function getSignUp()
    {
    	return view('auth.signup');	
    }

    public function postSignUp(AuthStoreRequest $requset)
    {
    	User::create([
    		'username' => $requset->input('username'),
    		'email'    => $requset->input('email'),
    		'password' => bcrypt($requset->input('password'))
 
    	]);

    	return redirect()->route('home')->with('info', 'Your account has been created and you can now sign in');
    }

    public function getSignIn()
    {
    	return view('auth.signin');
    }


    public function postSignIn(AuthLoginRequest $requset)
    {
    	if (! auth()->attempt($requset->only(['email', 'password']), $requset->has('remember'))) {
    		return redirect()->back()->with('info', 'Could not sign you in with those details');
    	}

    	return redirect()->route('home')->with('info', 'You are now signed in.');
    }

    public function getSignOut()
    {
    	auth()->logout();


    	return redirect()->route('home');	
    }
}


