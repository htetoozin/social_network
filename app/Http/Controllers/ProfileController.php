<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');	
	}

    public function getProfile($username)
    {
    	$user = User::where('username', $username)->first();

    	if (!$user) {
    		abort(404);
    	}
    	return view('profile.index', compact('user'));
    }


    public function getEdit()
    {
    	return view('profile.edit');
    }
 

    public function postEdit(UpdateProfileRequest $request)
    {
       auth()->user()->update($request->all());


        return redirect()->route('profile.edit')->with('info', 'Your Profile has been updated!');
    }
}
