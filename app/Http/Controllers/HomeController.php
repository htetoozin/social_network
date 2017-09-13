<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	if (auth()->check()) {
    		$statuses = Status::where(function($query){
    			return $query->where('user_id', auth()->user()->id)
    			->orWhereIn('user_id', auth()->user()->friends()->pluck('id'));

	
    		})
    		->orderBy('created_at', 'desc')
    		->get();

    		return view('timeline.index', compact('statuses'));
    	}
    	return view('home');	
    }
}
