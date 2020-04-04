<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use Auth;
use Toastr;

class CommentController extends Controller
{
    function store(Request $request, $post)
    {
    	//return $request->all();

    	$this->validate($request,array(
            'comment' => 'required'
        ));


    	$comment = new Comment;

    	$comment->user_id = Auth::user()->id;
    	$comment->post_id = $post;
    	$comment->comment = $request->input('comment');
    	$comment->save();

    	Toastr::success('Comment Successfully Published ', 'Success');

        return redirect()->back();

    }
}
