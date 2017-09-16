<?php

namespace App\Http\Controllers;

use App\Models\Status;
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

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000',
        ], [
            'required' => 'The reply body is required.'
        ]);

        $status = Status::notReply()->find($statusId);

        if (!$status) {
            return redirect()->route('home');
        }


        if (! auth()->user()->isFriendWith($status->user) && auth()->user()->id !== $status->user->id) {
            return redirect()->route('home');
        }

        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(auth()->user());

        $status->replies()->save($reply);

        return redirect()->back();
    }


    public function getLike($statusId){
        
        $status = Status::find($statusId);

        if (!$status) {
            return redirect()->route('home');
        }

        if (!auth()->user()->isFriendWith($status->user)) {
            return redirect()->route('home');
        }

        if (auth()->user()->hasLikedStatus($status)) {
            return redirect()->back();
        }

        $like = $status->likes()->create([]);
        auth()->user()->likes()->save($like);

        return redirect()->back();
    }

    
}
