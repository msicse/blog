<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use Toastr;
use Auth;

class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::where('user_id',Auth::user()->id)->latest()->get();
    	return view('backend.author.comments')->withComments($comments);
    }

    public function delete($id)
    {
  
    	$comments = Comment::find($id);

    	if ( $comments->user_id == Auth::id() ) {
    		$comments->replies()->delete();
    		$comments->delete();

    		Toastr::success('Successfully Deleted ', 'Success');
    	}else {
    		Toastr::error("You don\'t have permission to delete ","Error",["positionClass" => "toast-top-right"]);
    	}

    	return redirect()->back();
    	
    }
}
