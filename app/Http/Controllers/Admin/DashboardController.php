<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;
use App\User;

use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
    	$dt = Carbon::toDay();
    	$posts = Post::all();
    	$categories = Category::all();
    	$tags = Tag::all();
    	$pending = Post::where('is_approved',false)->count();
    	$authors = User::where('role_id',2)->get();
    	$newAuthor = User::whereDate('created_at',$dt)->count();

    	return view('backend.admin.dashboard')->with(compact("posts","categories","tags","pending","authors","newAuthor"));
    	//return view('backend.admin.dashboard')->withPosts($posts)->withCategories($categories)->withTags($tags);
    }
}
