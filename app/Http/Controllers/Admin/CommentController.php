<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use Toastr;
class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::latest()->get();
    	return view('backend.admin.comments')->withComments($comments);
    }

    public function delete($id)
    {
    	$comments = Comment::find($id);
    	$comments->replies()->delete();
    	$comments->delete();

    	Toastr::success('Successfully Deleted ', 'Success');

    	return redirect()->back();
    	
    }
}
