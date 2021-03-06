<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');	
	}

    public function getIndex()
    {
    	$friends = auth()->user()->friends();
    	$requests = auth()->user()->friendRequests();
    	return view('friends.index', compact('friends', 'requests'));	
    }

    public function getAdd($username)
    {
    	$user = auth()->user()->where('username', $username)->first();

    	if (!$user) {
    		return redirect()->route('home')->with('info','That user could not be found');
    	}

    	if (auth()->user()->id == $user->id) {
    		return redirect()->route('home');
    	}

    	if (auth()->user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(auth()->user()) ) {
    		return redirect()->route('profile.index', $user->username)->with('info', 'Friend Request Pending');
    	}

    	if (auth()->user()->isFriendWith($user)) {
    		return redirect()->route('profile.index', $user->username)->with('info', 'You are already friends');
    	}

    	if (auth()->user() == $user) {
    		return redirect()->route('profile.index', $user->username);
    	}

    	auth()->user()->addFriend($user);

    	return redirect()->route('profile.index', ['username' => $username])->with('info', 'Friend request sent.');
    }


    public function getAccept($username)
    {
    	$user = auth()->user()->where('username', $username)->first();

    	if (!$user) {
    		return redirect()->route('home')->with('info','That user could note be found');
    	}

    	if (!auth()->user()->hasFriendRequestReceived($user)) {
    		return redirect()->route('home');
    	}

    	auth()->user()->acceptFriendRequest($user);

    	return redirect()->route('profile.index', $username)->with('info', 'Friend Request Accepted');
    }

    public function postDelete($username)
    {
        $user = User::where('username', $username)->first();

        if (!auth()->user()->isFriendWith($user)) {
            return redirect()->back();
        }

        auth()->user()->deleteFriend($user);


        return redirect()->back()->with('info', 'Friend Delete.');


    }
}
