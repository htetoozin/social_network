<?php

namespace App\Http\Controllers;

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
}
