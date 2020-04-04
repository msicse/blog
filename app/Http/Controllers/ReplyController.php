<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reply;
use Auth;
use Toastr; 

class ReplyController extends Controller
{
    public function store( Request $request, $comment){

    	$this->validate($request,array(
            'reply' => 'required'
        ));


    	$reply = new Reply;

    	$reply->user_id = Auth::user()->id;
    	$reply->comment_id = $comment;
    	$reply->reply = $request->input('reply');
    	$reply->save();

    	Toastr::success('Comment Successfully Published ', 'Success');

        return redirect()->back();
    }
    
}
