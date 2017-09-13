<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);

        auth()->user()->statuses()->create([
            'body' => $request->input('status')
        ]);

        return redirect()->route('home')->with('info', 'Status Posted.');

    }

    
}
