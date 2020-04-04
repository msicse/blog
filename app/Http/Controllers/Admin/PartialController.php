<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartialController extends Controller
{
    public function index(){
        $posts = Post::where('is_approved',0)->get();
        return view('backend.admin.pending-post')->withPosts($posts);
    }

    public function comments(){
        $posts = Post::all();
        return view('backend.admin.comments')->withPosts($posts);
    }
    public function favorite(){
        $posts = Post::all();
        return view('backend.admin.favorite')->withPosts($posts);
    }
}
