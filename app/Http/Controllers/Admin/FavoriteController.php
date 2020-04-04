<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Toastr;

class FavoriteController extends Controller
{
    function index()
    {
        $posts = Auth::user()->favorite_posts()->latest()->get();
        return view('backend.admin.favorite')->withPosts($posts);
    }

    function delete($id)
    {
        Auth::user()->favorite_posts()->detach($id);

    	Toastr::success('The post is removed from Favorite list ', 'Success');
    	
        return redirect()->back();
    }
}
