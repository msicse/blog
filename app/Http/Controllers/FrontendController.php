<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Session;

class FrontendController extends Controller
{
    
    function category($category)
    {
    	$category = Category::where('slug',$category)->first();
    	$posts = $category->posts()->apporved()->published()->latest()->paginate(12);
    	//return $posts;

    	return view('frontend.category')->withCategory($category)->withPosts($posts);
    }
    function tags($slug)
    {
    	$tag = Tag::where('slug',$slug)->first();
    	$posts = $tag->posts()->apporved()->published()->latest()->paginate(12);

    	return view('frontend.tag')->with(compact('posts','tag'));
    }

    function posts()
    {
    	$posts = Post::apporved()->published()->latest()->paginate(21);
    	return view('frontend.posts')->withPosts($posts);
    }
    function SinglePost($slug)
    {
    	$post = Post::where('slug',$slug)->first();

    	$randoms = Post::apporved()->published()->take(3)->inRandomOrder()->get();

        $blogKey = 'blog_' . $post->id;

        if (!Session::has($blogKey)) {
            $v = $post->increment('view_count');
            //return $v;
            Session::put($blogKey, 1);
        }

       // return rand(5, 100);

    	return view('frontend.post')->with(compact('post','randoms'));
    }

    function author($name)
    {
    	$author = User::where('username',$name)->first();
    	$posts = $author->posts()->apporved()->published()->latest()->paginate(12);
    	return view('frontend.author')->with(compact('author','posts'));

    }

    public function search( Request $request)
    {
        
        $query = $request->input('query');
        $posts = Post::where('title','like','%'.$query.'%')->apporved()->published()->latest()->paginate(16);

        return view('frontend.search')->with(compact('query','posts'));
    }

     public function username(Request $request)
    {
        $name = $request->username;
        $username = User::where('username',$name)->exists();
        $msg = '';

        if ($username) {
            $msg = 'ex';
        }else {
           $msg = 'ok';
        }

    return $msg;
    }

}
